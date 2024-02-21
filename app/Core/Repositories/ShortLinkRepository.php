<?php

declare(strict_types=1);

namespace App\Core\Repositories;

use App\Core\Repositories\Exception\ModelNotFoundException;
use App\Models\ShortLink;
use Core\Domain\ClickShortLinkDomain;
use Core\Domain\Contracts\ShortLinkRepositoryInterface;
use Core\Domain\ShortLinkDomain;
use Core\Domain\ValueObject\Code;
use Shared\ValueObject\Id;

class ShortLinkRepository implements ShortLinkRepositoryInterface
{
    public function __construct(protected ShortLink $shortLink)
    {
    }

    public function register(ShortLinkDomain $shortLinkDomain): ShortLinkDomain
    {
        $model = $this->shortLink->fill([
            'id' => $shortLinkDomain->id(),
            'created_at' => $shortLinkDomain->createdAt(),
            'url' => $shortLinkDomain->url,
            'date_expired_at' => $shortLinkDomain->dateExpiredAt,
            'hash' => (string)$shortLinkDomain->hash,
            'total' => $shortLinkDomain->total,
        ]);

        $model->save();

        return $this->getDomainByModel($model);
    }

    public function getByHash(string $hash): ShortLinkDomain
    {
        $model = $this->shortLink->where('hash', $hash)
            ->where('date_expired_at', '>=', now())
            ->orderBy('created_at', 'desc')
            ->first();

        if (empty($model)) {
            throw new ModelNotFoundException($hash, $this->shortLink::class);
        }

        return $this->getDomainByModel($model);
    }

    public function addClick(string $id, ClickShortLinkDomain $linkDomain): ClickShortLinkDomain
    {
        $model = $this->shortLink->find($id);
        if (empty($model)) {
            throw new Exception\ModelNotFoundException($id, $this->shortLink::class);
        }

        $modelClick = $model->click()->create([
            'id' => $linkDomain->id(),
            'created_at' => $linkDomain->createdAt(),
            'ip' => $linkDomain->ip,
        ]);

        return new ClickShortLinkDomain(
            ip: $modelClick->ip,
            id: new Id($modelClick->id),
            createdAt: $modelClick->created_at
        );
    }

    /**
     * @param ShortLink $model
     * @return ShortLinkDomain
     */
    protected function getDomainByModel(ShortLink $model): ShortLinkDomain
    {
        return new ShortLinkDomain(
            url: $model->url,
            dateExpiredAt: $model->date_expired_at,
            total: $model->total,
            hash: new Code($model->hash),
            id: new Id($model->id),
            createdAt: $model->created_at,
        );
    }
}
