<?php

namespace Core\Infra\UseCases;

use Core\Domain\Entity\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\Cache\ShortLinkCacheInterface;
use Core\Infra\Exception\ShortLinkNotFoundException;
use Core\Infra\UseCases\DTO\RedirectShortLink\RedirectShortLinkInput;
use Core\Infra\UseCases\DTO\RedirectShortLink\RedirectShortLinkOutput;
use Core\Shared\Interfaces\PublishInterface;
use DateTime;

readonly class RedirectShortLink
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shortLinkRepository,
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
            $entity = $this->shortLinkRepository->findShortLinkByHash($input->hash);
            if (empty($entity)) {
                throw new ShortLinkNotFoundException($input->hash);
            }
            $this->cache->set($entity->getHash(), $cache = $entity->getDataCache(), ShortLink::$EXPIRED_IN);
        }

        $this->publish->message("short_link", [
                "ip" => $input->ip,
                'date' => (new DateTime())->format('Y-m-d H:i:s'),
        ] + $cache);

        return new RedirectShortLinkOutput(url: $cache['endpoint']);
    }
}
