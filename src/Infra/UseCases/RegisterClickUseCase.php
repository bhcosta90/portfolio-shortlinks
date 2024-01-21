<?php

namespace Core\Infra\UseCases;

use Core\Domain\Entity\ShortLinkHistoryDomain;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\UseCases\DTO\RegisterClick\RegisterClickInput;
use Core\Infra\UseCases\DTO\RegisterClick\RegisterClickOutput;

readonly class RegisterClickUseCase
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shotLinkRepository,
    ) {
        //
    }

    public function execute(RegisterClickInput $input): RegisterClickOutput
    {
        $shortLink = $this->shotLinkRepository->findShortLinkById($input->id);
        $click = new ShortLinkHistoryDomain(ip: $input->ip, createdAt: $input->createdAt);
        $shortLink->addClick($click);

        return new RegisterClickOutput(
            success: $this->shotLinkRepository->registerClick(
                $shortLink,
                $shortLink->getUpdatedAt()
            )
        );
    }
}
