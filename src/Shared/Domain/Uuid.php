<?php

namespace Core\Shared\Domain;

use Ulid\Ulid;

class Uuid
{
    protected function __construct(protected ?string $id)
    {
        $this->id = $this->id ?: Ulid::generate(true);
    }

    public static function make(?string $id): self
    {
        return (new self($id));
    }

    public function __toString(): string
    {
        return (string)$this->id;
    }
}
