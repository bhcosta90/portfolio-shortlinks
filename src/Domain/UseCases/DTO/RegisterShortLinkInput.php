<?php

namespace Core\Domain\UseCases\DTO;

readonly class RegisterShortLinkInput
{
    public function __construct(public string $url)
    {
        //
    }
}
