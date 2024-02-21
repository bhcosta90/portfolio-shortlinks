<?php

declare(strict_types=1);

namespace Shared\Abstracts;

use Shared\Contracts\EntityInterface;
use Shared\ValueObject\Id;

abstract class Entity implements EntityInterface
{
    public function __construct()
    {
        if (\property_exists($this, 'id')) {
            $this->{'id'} = $this->id ?: Id::make();
        }

        if (\property_exists($this, 'createdAt')) {
            $this->{'createdAt'} = $this->createdAt ?: new \DateTime();
        }
    }

    public function id(): string
    {
        return (string)$this->id;
    }

    public function createdAt(): string
    {
        return (string)$this->createdAt->format('Y-m-d H:i:s');
    }
}
