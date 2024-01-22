<?php

use Core\Domain\Entity\ShortLinkDomain;
use Core\Domain\Entity\ShortLinkHistoryDomain;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEmpty;

describe("ShortLinkTest Unit Test", function () {
    test("Create simple short link", function () {
        $entity = new ShortLinkDomain(url: 'testing', dateExpired: new DateTime());
        assertNotEmpty($entity->getId());
        assertNotEmpty($entity->getHash());
        assertCount(0, $entity->getHistories());
        assertEquals(8, strlen($entity->getHash()));
    });

    test("Add click in short link", function () {
        $click = new ShortLinkHistoryDomain(ip: '0.0.0.0', createdAt: new DateTime());
        $entity = new ShortLinkDomain(url: 'testing', dateExpired: new DateTime());
        expect($entity->getHistories())->toHaveCount(0);
        assertCount(0, $entity->getHistories());
        $entity->addHistory($click);
        assertCount(1, $entity->getHistories());
    });
});
