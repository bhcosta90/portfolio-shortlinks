<?php

namespace Core\Domain\UseCases;

use Core\Domain\Cache\ShortLinkCacheInterface;
use Core\Domain\Entity\ShortLink;
use Core\Domain\Exception\ShortLinkNotFoundException;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\RedirectShortLinkInput;
use Core\Domain\UseCases\DTO\RedirectShortLinkOutput;
use Core\Shared\Interfaces\PublishInterface;

readonly class RedirectShortLink
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shotLinkRepository,
        protected ShortLinkCacheInterface $cache,
        protected PublishInterface $publish,
    ) {
        //
    }

    /**
     * @throws ShortLinkNotFoundException
     */
    public function execute(RedirectShortLinkInput $input): RedirectShortLinkOutput
    {
        $cache = $this->cache->get($input->hash);

        if (empty($cache)) {
            $entity = $this->shotLinkRepository->findShortLinkByHash($input->hash);
            if (empty($entity)) {
                throw new ShortLinkNotFoundException($input->hash);
            }
            $this->cache->set($entity->getHash(), $cache = $entity->getDataCache(), ShortLink::$EXPIRED_IN);
        }

        $this->publish->message("short_link", [
            "ip" => $input->ip
        ] + $cache);

        return new RedirectShortLinkOutput(url: $cache['endpoint']);
    }
}