<?php

namespace Core\Domain\UseCases\DTO;

readonly class RegisterClickOutput
{
    public function __construct(public string $url)
    {
        //
    }
}
