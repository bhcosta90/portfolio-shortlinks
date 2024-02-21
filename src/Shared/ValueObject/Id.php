<?php

declare(strict_types=1);

namespace Shared\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class Id implements Contracts\ValueObjectInterface
{
    public function __construct(protected mixed $value)
    {
        $this->validate();
    }

    private function validate(): void
    {
        if (!Uuid::isValid($this->value)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>', static::class, $this->value)
            );
        }
    }

    public static function make(...$args): self
    {
        return new self($args ?: Uuid::uuid7()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
