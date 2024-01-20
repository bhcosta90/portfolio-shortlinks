<?php

namespace Core\Infra\UseCases\DTO\RegisterShortLink;

readonly class RegisterShortLinkInput
{
    public function __construct(public string $url)
    {
        //
    }
}
