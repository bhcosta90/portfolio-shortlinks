<?php

namespace Core\Infra\UseCases\DTO\ShowShortLink;

readonly class ShowShortLinkOutput
{
    public function __construct(public string $id, public string $endpoint, public int $total)
    {
        //
    }
}
