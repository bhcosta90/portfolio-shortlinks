<?php

declare(strict_types=1);

namespace Core\Domain;

use Core\Domain\ValueObject\Code;
use DateTime;
use Shared\Abstracts\Entity;
use Shared\ValueObject\Id;

/**
 * @property string $url,
 * @property ?DateTime $dateExpiredAt = null,
 * @property int $total = 0,
 * @property ?Code $hash = null,
 */
class ShortLinkDomain extends Entity
{
    public static int $EXPIRED_IN = 86400; // cache of 1 day

    /**
     * @var ClickShortLinkDomain[]
     */
    protected array $clicks = [];

    public function __construct(
        protected string $url,
        protected ?DateTime $dateExpiredAt = null,
        protected int $total = 0,
        protected ?Code $hash = null,
        protected ?Id $id = null,
        protected ?DateTime $createdAt = null,
    ) {
        parent::__construct();

        $this->hash = $this->hash ?: Code::make();
        $this->dateExpiredAt = $this->dateExpiredAt ?: (new DateTime())->modify(self::$EXPIRED_IN . " seconds");
    }

    public function addClick(ClickShortLinkDomain $clickShortLinkDomain): void
    {
        $this->total++;
        $this->clicks[] = $clickShortLinkDomain;
    }
}
