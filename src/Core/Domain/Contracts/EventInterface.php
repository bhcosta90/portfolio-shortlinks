<?php

declare(strict_types=1);

namespace Core\Domain\Contracts;

interface EventInterface
{
    public function payload(): array;
}
