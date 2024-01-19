<?php

namespace Core\Domain\UseCases\DTO;

readonly class RegisterClickInput
{
    public function __construct(public string $hash, public string $ip)
    {
        //
    }
}
