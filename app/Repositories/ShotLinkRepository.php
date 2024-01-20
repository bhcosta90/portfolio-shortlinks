<?php

namespace App\Repositories;

use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Shared\Interfaces\PaginationInterface;
use DateTime;

class ShotLinkRepository implements ShotLinkRepositoryInterface
{
    public function __construct(protected \App\Models\ShortLink $shortLink, protected \App\Models\Click $click)
    {
        //
    }

    public function register(ShortLink $shortLink): bool
    {
        return (bool)$this->shortLink->create([
            'id' => $shortLink->getId(),
            'hash' => $shortLink->getHash(),
            'url' => $shortLink->getUrl(),
            'total' => count($shortLink->getClicks()),
        ]);
    }

    public function registerClick(ShortLink $shortLink, DateTime $dateTime): bool
    {
        $model = $this->shortLink->find($shortLink->getId());

        $updated = $model->update([
            'total' => (int) $model->total + 1
        ], [
            'updated_at' => $dateTime
        ]);

        if ($updated) {
            foreach ($shortLink->getClicks() as $click) {
                $model->clicks()->create([
                    'id' => $click->getId(),
                    'short_link_id' => $shortLink->getId(),
                    'ip_address' => $click->getIp(),
                    'created_at' => $click->getCreatedAt(),
                ]);
            }
        }

        return $updated;
    }

    public function findShortLinkByHash(string $hash): ?ShortLink
    {
        $model = $this->shortLink->where('hash', $hash)->first();

        if ($model) {
            return new ShortLink(
                url: $model->url,
                total: $model->total,
                hash: $model->hash,
                id: $model->id,
                updatedAt: $model->updated_at
            );
        }

        return null;
    }

    public function findShortLinkById(string $id): ShortLink
    {
        $model = $this->shortLink->findOrFail($id);
        return new ShortLink(
            url: $model->url,
            total: $model->total,
            hash: $model->hash,
            id: $model->id,
            updatedAt: $model->updated_at
        );
    }


    public function totalClick(string $idShortLink): int
    {
        $model = $this->shortLink->find($idShortLink);
        return $model->clicks->count();
    }

    public function paginateHistoriesByShortLink(int $page, ShortLink $shortLink): PaginationInterface
    {
        $model = $this->shortLink->findOrFail($shortLink->getId());
        return new PaginationPresenter($model->clicks()->orderBy('created_at', 'desc')->paginate(page: $page));
    }
}
