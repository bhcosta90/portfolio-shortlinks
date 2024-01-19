<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Click;
use Core\Domain\Entity\ShortLink;

interface ShotLinkRepositoryInterface
{
    public function register(ShortLink $shortLink): bool;

    public function registerClick(ShortLink $shortLink, Click $click): bool;

    public function findShortLinkByUrl(string $url): ?ShortLink;

    public function totalClick(string $idShortLink): int;
}
