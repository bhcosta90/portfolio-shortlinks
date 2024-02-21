<?php

declare(strict_types=1);

namespace Shared\Abstracts;

use Shared\Contracts\EntityInterface;
use Shared\Traits\MethodMagicTrait;
use Shared\ValueObject\Id;

abstract class Entity implements EntityInterface
{
    use MethodMagicTrait;

    public function __construct()
    {
        if (\property_exists($this, 'id')) {
            $this->{'id'} = $this->id ?: Id::make();
        }

        if (\property_exists($this, 'createdAt')) {
            $this->{'createdAt'} = $this->createdAt ?: new \DateTime();
        }
    }

    public function id(): ?string
    {
        if (\property_exists($this, 'id')) {
            return (string)$this->id;
        }
        return null;
    }

    public function createdAt(): ?string
    {
        if (\property_exists($this, 'createdAt')) {
            return (string)$this->createdAt->format('Y-m-d H:i:s');
        }
        return null;
    }
}
