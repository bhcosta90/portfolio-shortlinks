<?php

declare(strict_types=1);

namespace Core\Domain\Contracts;

use Core\Domain\ShortLinkDomain;

interface ShortLinkCacheInterface
{
    public function get(string $hash): ?ShortLinkDomain;

    public function set(string $hash, ShortLinkDomain $domain, int $time): void;
}
