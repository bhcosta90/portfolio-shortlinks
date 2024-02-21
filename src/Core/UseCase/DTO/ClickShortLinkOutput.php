<?php

declare(strict_types=1);

namespace Core\UseCase\DTO;

use Core\Domain\ClickShortLinkDomain;

class ClickShortLinkOutput
{
    protected function __construct(
        public string $id,
        public string $created_at,
        public string $ip,
    ) {
        //
    }

    public static function make(ClickShortLinkDomain $linkDomain): self
    {
        return new self(
            id: $linkDomain->id(),
            created_at: $linkDomain->createdAt(),
            ip: $linkDomain->ip,
        );
    }
}
