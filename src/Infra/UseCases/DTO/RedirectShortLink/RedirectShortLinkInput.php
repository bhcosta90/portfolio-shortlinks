<?php

namespace Core\Infra\UseCases\DTO\RedirectShortLink;

readonly class RedirectShortLinkInput
{
    public function __construct(public string $hash, public string $ip)
    {
        //
    }
}
