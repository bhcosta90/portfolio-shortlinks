<?php

declare(strict_types=1);

namespace Core\Domain\Contracts;

interface ShortLinkEventManagerInterface
{
    public function dispatch(EventInterface $event): void;
}
