<?php

namespace Core\Domain\Entity;

use Core\Shared\Domain\Uuid;

class Click
{
    public function __construct(
        protected string $ip,
        protected ?string $id = null,
    ) {
        $this->id = (string)Uuid::make($this->id);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
