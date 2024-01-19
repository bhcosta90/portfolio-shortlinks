<?php

namespace App\Repositories;

use Core\Domain\Entity\Click;
use Core\Domain\Entity\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;

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

    public function registerClick(ShortLink $shortLink, Click $click): bool
    {
        $model = $this->shortLink->find($shortLink->getId());

        return (bool) $model->clicks->attach([
            'id' => $click->getId(),
            'short_link_id' => $shortLink->getId(),
            'ip_address' => $click->getIp(),
        ]);
    }

    public function findShortLinkByHash(string $hash): ?ShortLink
    {
        $model = $this->shortLink->where('hash', $hash)->first();

        if ($model) {
            return new ShortLink(url: $model->url, hash: $model->hash);
        }

        return null;
    }

    public function totalClick(string $idShortLink): int
    {
        $model = $this->shortLink->find($idShortLink);
        return $model->clicks->count();
    }
}
