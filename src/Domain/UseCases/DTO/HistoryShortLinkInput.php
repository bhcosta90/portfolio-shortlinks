<?php

namespace Core\Domain\UseCases\DTO;

readonly class HistoryShortLinkInput
{
    public function __construct(
        public string $id,
    ) {
        //
    }
}
