<?php

namespace Core\Domain\UseCases\DTO;

readonly class RegisterShortLinkOutput
{
    public function __construct(public string $id, public string $url, public string $hash)
    {
        //
    }
}