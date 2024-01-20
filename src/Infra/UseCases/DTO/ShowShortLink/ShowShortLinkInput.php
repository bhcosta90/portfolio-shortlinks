<?php

namespace Core\Infra\UseCases\DTO\ShowShortLink;

readonly class ShowShortLinkInput
{
    public function __construct(public string $hash){
        //
    }
}
