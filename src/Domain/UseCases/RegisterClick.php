<?php

namespace Core\Domain\UseCases;

use Core\Domain\Entity\Click;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\RegisterClickInput;
use Core\Domain\UseCases\DTO\RegisterClickOutput;

readonly class RegisterClick
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shotLinkRepository,
    ) {
        //
    }

    public function execute(RegisterClickInput $input): RegisterClickOutput
    {
        $shortLink = $this->shotLinkRepository->findShortLinkById($input->id);
        $click = new Click(ip: $input->ip, createdAt: $input->createdAt);
        $shortLink->addClick($click);

        return new RegisterClickOutput(
            success: $this->shotLinkRepository->registerClick(
                $shortLink,
                $shortLink->getUpdatedAt()
            )
        );
    }
}
