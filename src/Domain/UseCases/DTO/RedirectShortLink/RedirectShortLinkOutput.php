<?php

namespace Core\Domain\UseCases\DTO\RedirectShortLink;

readonly class RedirectShortLinkOutput
{
    public function __construct(public string $url)
    {
        //
    }
}
