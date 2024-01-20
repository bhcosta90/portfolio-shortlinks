<?php

namespace Core\Infra\UseCases\DTO\HistoryShortLink;

readonly class HistoryShortLinkInput
{
    public function __construct(
        public int $page,
        public string $id,
    ) {
        //
    }
}
