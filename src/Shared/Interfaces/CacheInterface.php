<?php

namespace Core\Shared\Interfaces;

interface CacheInterface
{
    public function set(string $key, $value, int $expiredIn): void;

    public function get(string $key);
}
