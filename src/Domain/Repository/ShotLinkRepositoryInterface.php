<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\ShortLinkDomain;
use Core\Shared\Interfaces\PaginationInterface;
use DateTime;

interface ShotLinkRepositoryInterface
{
    public function register(ShortLinkDomain $shortLink): bool;

    public function registerClick(ShortLinkDomain $shortLink, DateTime $dateTime): bool;

    public function findShortLinkByHash(string $hash): ?ShortLinkDomain;

    public function findShortLinkById(string $id): ShortLinkDomain;

    public function paginateHistoriesByShortLink(int $page, ShortLinkDomain $shortLink): PaginationInterface;
}
