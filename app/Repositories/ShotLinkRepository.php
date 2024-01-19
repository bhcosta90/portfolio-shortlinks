<?php

namespace App\Repositories;

use Core\Domain\Entity\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
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
            'total' => 1
        ], [
            'updated_at' => $dateTime
        ]);

        foreach ($shortLink->getClicks() as $click){
            $model->clicks()->create([
                'id' => $click->getId(),
                'short_link_id' => $shortLink->getId(),
                'ip_address' => $click->getIp(),
            ]);
        }

        return $updated;
    }

    public function findShortLinkByHash(string $hash): ?ShortLink
    {
        $model = $this->shortLink->where('hash', $hash)->first();

        if ($model) {
            return new ShortLink(url: $model->url, hash: $model->hash, updatedAt: $model->updated_at);
        }

        return null;
    }

    public function findShortLinkById(string $id): ShortLink
    {
        $model = $this->shortLink->findOrFail($id);
        return new ShortLink(
            url: $model->url,
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
}
