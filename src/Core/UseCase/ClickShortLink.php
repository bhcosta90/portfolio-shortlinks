<?php

declare(strict_types=1);

namespace Core\UseCase;

use Core\Domain\ClickShortLinkDomain;
use Core\Domain\Contracts\ShortLinkEventManagerInterface;
use Core\Domain\Events\ClickEvent;
use Core\Domain\Contracts\ShortLinkCacheInterface;
use Core\Domain\Contracts\ShortLinkRepositoryInterface;
use Core\UseCase\DTO\ShortLinkOutput;

class ClickShortLink
{
    public function __construct(
        protected ShortLinkRepositoryInterface $shortLinkRepository,
        protected ShortLinkCacheInterface $shortLinkCache,
        protected ShortLinkEventManagerInterface $shortLinkEventManager,
    ) {
        //
    }

    public function execute(string $hash, string $ip): ShortLinkOutput
    {
        if (!($entity = $cache = $this->shortLinkCache->get($hash))) {
            $entity = $this->shortLinkRepository->getByHash($hash);
            $this->shortLinkCache->set(
                hash: $hash,
                domain: $entity,
                time: $entity->dateExpiredAt->getTimestamp() - (new \DateTime())->getTimestamp()
            );
        }
        $entity->addClick(new ClickShortLinkDomain(ip: $ip));
        $this->shortLinkEventManager->dispatch(new ClickEvent(shortLinkDomain: $entity));
        return ShortLinkOutput::make($entity, cache: (bool) $cache);
    }
}
