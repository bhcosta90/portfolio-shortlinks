<?php

namespace Core\Domain\UseCases\DTO\ShowShortLink;

readonly class ShowShortLinkOutput
{
    public function __construct(public string $id, public string $endpoint, public int $total){
        //
    }
}
