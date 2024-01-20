<?php

namespace Core\Domain\Entity;

use Core\Shared\Domain\Code;
use Core\Shared\Domain\Uuid;
use DateTime;

class ShortLink
{
    public static int $EXPIRED_IN = 86400; // cache of 1 day

    public function __construct(
        protected string $url,
        protected int $total = 0,
        protected ?string $hash = null,
        /**
         * @var Click[]
         */
        protected array $clicks = [],
        protected ?string $id = null,
        protected ?DateTime $updatedAt = null,
    ) {
        $this->id = (string)Uuid::make($this->id);

        if (empty($this->hash)) {
            $this->hash = Code::make();
        }
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function addClick(Click $click): void
    {
        $this->clicks[] = $click;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function getClicks(): array
    {
        return $this->clicks;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function getDataCache(): array
    {
        return [
            'id' => $this->getId(),
            'endpoint' => $this->getUrl()
        ];
    }
}
