<?php

namespace Core\Infra\UseCases;

use Core\Domain\Entity\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\Cache\ShortLinkCacheInterface;
use Core\Infra\UseCases\DTO\RegisterShortLink\RegisterShortLinkInput;
use Core\Infra\UseCases\DTO\RegisterShortLink\RegisterShortLinkOutput;
use Core\Shared\Interfaces\DatabaseInterface;

readonly class RegisterShortLink
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shotLinkRepository,
        protected DatabaseInterface $database,
        protected ShortLinkCacheInterface $cache
    ) {
        //
    }

    public function execute(RegisterShortLinkInput $input): RegisterShortLinkOutput
    {
        $entity = new ShortLink(url: $input->url);

        $this->database->execute(function () use ($entity) {
            $this->shotLinkRepository->register($entity);
            $this->cache->set("short_link_" . $entity->getHash(), $entity->getDataCache(), ShortLink::$EXPIRED_IN);
        });

        return new RegisterShortLinkOutput(
            id: $entity->getId(),
            url: $entity->getUrl(),
            hash: $entity->getHash()
        );
    }
}
