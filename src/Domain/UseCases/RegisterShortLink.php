<?php

namespace Core\Domain\UseCases;

use Core\Domain\Cache\ShortLinkCacheInterface;
use Core\Domain\Entity\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\RegisterShortLinkInput;
use Core\Domain\UseCases\DTO\RegisterShortLinkOutput;
use Core\Shared\Interfaces\CacheInterface;
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
