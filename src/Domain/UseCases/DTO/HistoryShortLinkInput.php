<?php

namespace Core\Domain\UseCases\DTO;

use Core\Shared\Interfaces\UseCaseInterfaceInput;

readonly class HistoryShortLinkInput implements UseCaseInterfaceInput
{
    public function __construct(
        public string $id,
    ) {
        //
    }
}
