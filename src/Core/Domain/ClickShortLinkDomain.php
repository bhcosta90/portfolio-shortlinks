<?php

declare(strict_types=1);

namespace Core\Domain;

use Shared\Abstracts\Entity;
use Shared\ValueObject\Id;

class ClickShortLinkDomain extends Entity
{
    public function __construct(
        protected string $ip,
        protected ?Id $id = null,
        protected ?\DateTime $createdAt = null,
    ) {
        parent::__construct();
    }
}
