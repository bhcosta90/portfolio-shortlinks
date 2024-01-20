<?php

namespace Core\Domain\UseCases;

use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\ShowShortLink\ShowShortLinkInput;
use Core\Domain\UseCases\DTO\ShowShortLink\ShowShortLinkOutput;

readonly class ShowShortLink
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shotLinkRepository,
    ) {
        //
    }

    public function execute(ShowShortLinkInput $input): ShowShortLinkOutput
    {
        $shortLink = $this->shotLinkRepository->findShortLinkByHash($input->hash);

        return new ShowShortLinkOutput(
            id: $shortLink->getId(),
            endpoint: $shortLink->getUrl(),
            total: $shortLink->getTotal(),
        );
    }
}
