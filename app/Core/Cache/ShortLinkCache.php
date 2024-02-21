<?php

declare(strict_types=1);

namespace App\Core\Cache;

use Core\Domain\Contracts\ShortLinkCacheInterface;
use Core\Domain\ShortLinkDomain;
use Illuminate\Support\Facades\Cache;

class ShortLinkCache implements ShortLinkCacheInterface
{
    private const HASH = '0.0.0';

    public function get(string $hash): ?ShortLinkDomain
    {
        return Cache::get(self::HASH . '_' . $hash);
    }

    public function set(string $hash, ShortLinkDomain $domain, int $time): void
    {
        Cache::set(self::HASH . '_' . $hash, $domain, $time);
    }
}
