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

    /**
     * @throws ShortLinkNotFoundException
     */
    public function execute(ShowShortLinkInput $input): ShowShortLinkOutput
    {
        $shortLink = $this->shortLinkRepository->findShortLinkByHash($input->hash, null);

        if ($shortLink === null) {
            throw new ShortLinkNotFoundException($input->hash);
        }

        return new ShowShortLinkOutput(
            id: $shortLink->getId(),
            endpoint: $shortLink->getUrl(),
            total: $shortLink->getTotal(),
            isDateValid: $shortLink->isDateExpiredAt(),
        );
    }
}
