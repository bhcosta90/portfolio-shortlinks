<?php

namespace Core\Shared\Domain;

class Code
{
    public static function make(int $size = 8)
    {
        return (new self)->generate($size);
    }

    private function generate(int $size = 8): string
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        for ($i = 0; $i < $size; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return $code;
    }
}
