<?php

namespace Core\Domain\Entity;

use Core\Shared\Domain\Uuid;
use DateTime;

class ClickDomain
{
    public function __construct(
        protected string $ip,
        protected DateTime $createdAt,
        protected ?string $id = null,
    ) {
        $this->id = (string)Uuid::make($this->id);
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
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
