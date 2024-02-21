<?php

declare(strict_types=1);

namespace Core\UseCase;

use Core\Domain\Contracts\ShortLinkCacheInterface;
use Core\Domain\Contracts\ShortLinkRepositoryInterface;
use Core\UseCase\DTO\ShortLinkOutput;

class ShowShortLink
{
    public function __construct(
        protected ShortLinkRepositoryInterface $shortLinkRepository,
        protected ShortLinkCacheInterface $shortLinkCache,
    ) {
        //
    }

    public function execute(string $id): ShortLinkOutput
    {
        return ShortLinkOutput::make($this->shortLinkRepository->getById($id));
    }
}
