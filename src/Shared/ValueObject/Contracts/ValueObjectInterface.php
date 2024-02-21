<?php

declare(strict_types=1);

namespace Shared\ValueObject\Contracts;

interface ValueObjectInterface
{
    public function __construct(mixed $value);

    public function __toString(): string;

    public static function make(...$args): self;
}
