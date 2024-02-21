<?php

declare(strict_types=1);

namespace Core\Domain\Contracts;

use Core\Domain\ClickShortLinkDomain;
use Core\Domain\ShortLinkDomain;

interface ShortLinkRepositoryInterface
{
    public function register(ShortLinkDomain $shortLinkDomain): ShortLinkDomain;

    public function getByHash(string $hash): ShortLinkDomain;

    public function getById(string $id): ShortLinkDomain;

    public function addClick(string $id, ClickShortLinkDomain $linkDomain): ClickShortLinkDomain;
}
