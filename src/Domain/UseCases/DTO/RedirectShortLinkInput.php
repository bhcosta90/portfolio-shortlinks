<?php

namespace Core\Domain\UseCases\DTO;

readonly class RedirectShortLinkInput
{
    public function __construct(public string $hash, public string $ip)
    {
        //
    }
}
