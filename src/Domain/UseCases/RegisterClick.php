<?php

namespace Core\Domain\UseCases;

use Core\Domain\Cache\ShortLinkCacheInterface;
use Core\Domain\Entity\ShortLink;
use Core\Domain\Exception\ShortLinkNotFoundException;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\RegisterClickInput;
use Core\Domain\UseCases\DTO\RegisterClickOutput;
use Core\Shared\Interfaces\PublishInterface;

class RegisterClick
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
    public function execute(RegisterClickInput $input): RegisterClickOutput
    {
        $endpoint = $this->cache->get($input->hash);

        if (empty($endpoint)) {
            $entity = $this->shotLinkRepository->findShortLinkByHash($input->hash);
            if (empty($entity)) {
                throw new ShortLinkNotFoundException($input->hash);
            }
            $this->cache->set($entity->getHash(), $endpoint = $entity->getUrl(), ShortLink::$EXPIRED_IN);
        }

        $this->publish->message("short_link", [
            'endpoint' => $endpoint,
            "id" => $input->ip,
        ]);

        return new RegisterClickOutput(url: $endpoint);
    }
}
