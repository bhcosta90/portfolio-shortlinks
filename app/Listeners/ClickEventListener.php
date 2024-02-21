<?php

namespace App\Listeners;

use Core\UseCase\RegisterClickShortLink;
use Core\Domain\Events\ClickEvent;

class ClickEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct(protected RegisterClickShortLink $registerClickShortLink)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClickEvent $event): void
    {
        $clicks = $event->payload()['short-link']->clicks;
        $click = end($clicks);
        $this->registerClickShortLink->execute(id: $event->payload()['short-link']->id(), shortLinkDomain: $click);
    }
}
