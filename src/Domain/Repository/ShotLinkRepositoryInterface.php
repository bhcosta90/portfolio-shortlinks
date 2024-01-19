<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Click;
use Core\Domain\Entity\ShortLink;
use DateTime;

interface ShotLinkRepositoryInterface
{
    public function register(ShortLink $shortLink): bool;

    public function registerClick(ShortLink $shortLink, DateTime $dateTime): bool;

    public function findShortLinkByHash(string $hash): ?ShortLink;

    public function findShortLinkById(string $id): ShortLink;

    public function totalClick(string $idShortLink): int;
}
