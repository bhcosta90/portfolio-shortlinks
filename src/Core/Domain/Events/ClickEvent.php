<?php

declare(strict_types=1);

namespace Core\Domain\Events;

use Core\Domain\Contracts\EventInterface;
use Core\Domain\ShortLinkDomain;

class ClickEvent implements EventInterface
{
    public function __construct(protected ShortLinkDomain $shortLinkDomain)
    {
    }

    public function payload(): array
    {
        return [
            'short-link' => $this->shortLinkDomain,
        ];
    }
}
