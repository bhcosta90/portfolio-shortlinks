<?php

namespace App\Repositories\Eloquent;

use App\Models\ShortLink;
use App\Models\ShortLinkHistory;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\ShortLinkDomain;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Shared\Interfaces\PaginationInterface;
use DateTime;
use Exception;

class ShotLinkRepository implements ShotLinkRepositoryInterface
{
    public function __construct(
        protected ShortLink $shortLink,
        protected ShortLinkHistory $click
    ) {
        //
    }

    public function register(ShortLinkDomain $shortLink): bool
    {
        return (bool)$this->shortLink->create([
            'id' => $shortLink->getId(),
            'hash' => $shortLink->getHash(),
            'url' => $shortLink->getUrl(),
            'total' => 0,
            'expired_at' => $shortLink->calculateDateExpired(),
        ]);
    }

    public function registerClick(ShortLinkDomain $shortLink, DateTime $dateTime): bool
    {
        $model = $this->shortLink->find($shortLink->getId());

        $updated = $model->update([
            'total' => (int)$model->total + 1
        ], [
            'updated_at' => $dateTime
        ]);

        if ($updated) {
            foreach ($shortLink->getHistories() as $click) {
                $model->shortLinkHistories()->create([
                    'id' => $click->getId(),
                    'short_link_id' => $shortLink->getId(),
                    'ip_address' => $click->getIp(),
                    'created_at' => $click->getCreatedAt(),
                ]);
            }
        }

        return $updated;
    }

    public function findShortLinkByHash(string $hash, ?DateTime $dateExpiredAt): ?ShortLinkDomain
    {
        $result = $this->shortLink->where('hash', $hash);

        if ($dateExpiredAt) {
            $result->where('expired_at', '>=', $dateExpiredAt);
        }

        $model = $result->first();

        if ($model) {
            return $this->toEntity($model);
        }

        return null;
    }

    public function findShortLinkById(string $id): ShortLinkDomain
    {
        $model = $this->shortLink->findOrFail($id);
        return $this->toEntity($model);
    }

    public function paginateHistoriesByShortLink(int $page, ShortLinkDomain $shortLink): PaginationInterface
    {
        $model = $this->shortLink->findOrFail($shortLink->getId());
        return new PaginationPresenter(
            $model->shortLinkHistories()->orderBy('created_at', 'desc')->paginate(page: $page)
        );
    }

    /**
     * @throws Exception
     */
    private function toEntity(object $data): ShortLinkDomain{
        return new ShortLinkDomain(
            url: $data->url,
            dateExpired: new DateTime($data->expired_at),
            total: $data->total,
            hash: $data->hash,
            id: $data->id,
            updatedAt: $data->updated_at
        );
    }
}
