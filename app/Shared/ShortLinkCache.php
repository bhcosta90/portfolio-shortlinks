<?php

namespace App\Shared;

use Core\Infra\Cache\ShortLinkCacheInterface;
use Illuminate\Support\Facades\Cache;

class ShortLinkCache implements ShortLinkCacheInterface
{

    protected static string $KEY = 'a';

    public function set(string $key, $value, int $expiredIn): void
    {
        Cache::set(self::$KEY . "_short_link_" . $key, $value, $expiredIn);
    }

    public function get(string $key)
    {
        return Cache::get(self::$KEY . "_short_link_" . $key);
    }
}
