<?php

namespace Core\Domain\UseCases\DTO\HistoryShortLink;

readonly class HistoryShortLinkInput
{
    public function __construct(
        public string $id,
    ) {
        //
    }
}
