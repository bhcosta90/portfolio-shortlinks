<?php

namespace Core\Domain\UseCases\DTO;

readonly class RedirectShortLinkOutput
{
    public function __construct(public string $url)
    {
        //
    }
}
