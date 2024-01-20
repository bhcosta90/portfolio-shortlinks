<?php

use Core\Domain\Entity\Click;
use Core\Domain\Entity\ShortLink;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertEquals;

describe("ShortLinkTest Unit Test", function () {
    test("Create simple short link", function () {
        $entity = new ShortLink(url: 'testing');
        assertNotEmpty($entity->getId());
        assertNotEmpty($entity->getHash());
        assertCount(0, $entity->getClicks());
        assertEquals(8, strlen($entity->getHash()));
    });

    test("Add click in short link", function(){
        $click = new Click(ip: '0.0.0.0', createdAt: new DateTime());
        $entity = new ShortLink(url: 'testing');
        expect($entity->getClicks())->toHaveCount(0);
        assertCount(0, $entity->getClicks());
        $entity->addClick($click);
        assertCount(1, $entity->getClicks());
    });
});
