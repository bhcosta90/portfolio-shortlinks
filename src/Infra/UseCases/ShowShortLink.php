<?php

namespace Core\Infra\UseCases;

use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\UseCases\DTO\ShowShortLink\ShowShortLinkInput;
use Core\Infra\UseCases\DTO\ShowShortLink\ShowShortLinkOutput;

readonly class ShowShortLink
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shortLinkRepository,
    ) {
        //
    }

    public function execute(ShowShortLinkInput $input): ShowShortLinkOutput
    {
        $shortLink = $this->shortLinkRepository->findShortLinkByHash($input->hash);

        return new ShowShortLinkOutput(
            id: $shortLink->getId(),
            endpoint: $shortLink->getUrl(),
            total: $shortLink->getTotal(),
        );
    }
}
