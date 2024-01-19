<?php

namespace App\Shared;

use Core\Shared\Interfaces\CacheInterface;

class Cache implements CacheInterface
{

    public function set(string $key, $value, int $expiredIn): void
    {
        \Illuminate\Support\Facades\Cache::set($key, $value, $expiredIn);
    }

    public function get(string $key)
    {
        return \Illuminate\Support\Facades\Cache::get($key);
    }
}
