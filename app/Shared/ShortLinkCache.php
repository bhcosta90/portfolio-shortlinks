<?php

namespace App\Shared;

use Core\Domain\Cache\ShortLinkCacheInterface;

class ShortLinkCache implements ShortLinkCacheInterface
{

    public function set(string $key, $value, int $expiredIn): void
    {
        \Illuminate\Support\Facades\Cache::set("short_link_" . $key, $value, $expiredIn);
    }

    public function get(string $key)
    {
        return \Illuminate\Support\Facades\Cache::get("short_link_" . $key);
    }
}
