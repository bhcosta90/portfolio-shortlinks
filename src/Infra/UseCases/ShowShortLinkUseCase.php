<?php

namespace Core\Infra\UseCases;

use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\Exception\ShortLinkNotFoundException;
use Core\Infra\UseCases\DTO\ShowShortLink\ShowShortLinkInput;
use Core\Infra\UseCases\DTO\ShowShortLink\ShowShortLinkOutput;

readonly class ShowShortLinkUseCase
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shortLinkRepository,
    ) {
        //
    }

    public function execute(ShowShortLinkInput $input): ShowShortLinkOutput
    {
        $shortLink = $this->shortLinkRepository->findShortLinkById($input->id);

        return new ShowShortLinkOutput(
            hash: $shortLink->getHash(),
            endpoint: $shortLink->getUrl(),
            total: $shortLink->getTotal(),
            isDateValid: $shortLink->isDateExpiredAt(),
        );
    }
}
