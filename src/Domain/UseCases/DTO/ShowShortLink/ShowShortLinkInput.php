<?php

namespace Core\Domain\UseCases\DTO\ShowShortLink;

readonly class ShowShortLinkInput
{
    public function __construct(public string $hash){
        //
    }
}
