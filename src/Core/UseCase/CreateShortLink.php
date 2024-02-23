<?php

declare(strict_types=1);

namespace Core\UseCase;

use Core\UseCase\DTO\ShortLinkOutput;
use Core\Domain\Contracts\ShortLinkRepositoryInterface;
use Core\Domain\ShortLinkDomain;

class CreateShortLink
{
    public function __construct(
        protected ShortLinkRepositoryInterface $shortLinkRepository
    ) {
        //
    }

    public function execute(string $url): ShortLinkOutput
    {
        $entity = new ShortLinkDomain(url: $url);
        $repoEntity = $this->shortLinkRepository->register($entity);
        return ShortLinkOutput::make($repoEntity);
    }
}
