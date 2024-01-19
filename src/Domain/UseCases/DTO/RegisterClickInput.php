<?php

namespace Core\Domain\UseCases\DTO;

readonly class RegisterClickInput
{
    public function __construct(public string $id, public string $ip)
    {
        //
    }
}
