<?php

namespace Core\Domain\UseCases\DTO;

readonly class ShowShortLinkOutput
{
    public function __construct(public string $endpoint, public int $total){
        //
    }
}
