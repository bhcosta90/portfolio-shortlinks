<?php

declare(strict_types=1);

namespace App\Core\Event;

use Core\Domain\Contracts\EventInterface;
use Core\Domain\Contracts\ShortLinkEventManagerInterface;

class ShortLinkEventManager implements ShortLinkEventManagerInterface
{
    public function dispatch(EventInterface $event): void
    {
        event($event);
    }
}
