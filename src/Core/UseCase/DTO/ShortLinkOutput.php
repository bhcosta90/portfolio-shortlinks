<?php

declare(strict_types=1);

namespace Core\UseCase\DTO;

use Core\Domain\ShortLinkDomain;

class ShortLinkOutput
{
    protected function __construct(
        public string $hash,
        public string $date_expired_at,
        public string $url,
        public int $total,
        public string $id,
        public string $created_at,
        public bool $cache,
    ) {
        //
    }

    public static function make(ShortLinkDomain $shortLinkDomain, bool $cache = false): self
    {
        return new self(
            hash: (string)$shortLinkDomain->hash,
            date_expired_at: $shortLinkDomain->dateExpiredAt->format('Y-m-d H:i:s'),
            url: $shortLinkDomain->url,
            total: $shortLinkDomain->total,
            id: $shortLinkDomain->id(),
            created_at: $shortLinkDomain->createdAt(),
            cache: $cache
        );
    }
}
