<?php

namespace Core\Domain\UseCases\DTO\RegisterShortLink;

readonly class RegisterShortLinkInput
{
    public function __construct(public string $url)
    {
        //
    }
}
