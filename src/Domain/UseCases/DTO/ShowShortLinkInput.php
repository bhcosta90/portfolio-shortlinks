<?php

namespace Core\Domain\UseCases\DTO;

readonly class ShowShortLinkInput
{
    public function __construct(public string $hash){
        //
    }
}
