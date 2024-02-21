<?php

declare(strict_types=1);

namespace Core\UseCase;

use Core\UseCase\DTO\ClickShortLinkOutput;
use Core\Domain\ClickShortLinkDomain;
use Core\Domain\Contracts\ShortLinkRepositoryInterface;

class RegisterClickShortLink
{
    public function __construct(protected ShortLinkRepositoryInterface $shortLinkRepository)
    {
    }

    public function execute(string $id, ClickShortLinkDomain $shortLinkDomain): ClickShortLinkOutput
    {
        $click = $this->shortLinkRepository->addClick($id, $shortLinkDomain);
        return ClickShortLinkOutput::make($click);
    }
}
