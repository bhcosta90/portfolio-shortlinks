<?php

declare(strict_types=1);

use Core\Domain\ClickShortLinkDomain;


use Shared\ValueObject\Id;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEmpty;

describe("ClickShortLinkDomain Unit Test", function () {
    test("creating the object with minimal data", function () {
        $domain = new ClickShortLinkDomain(
            ip: 'testing',
        );

        assertEquals('testing', $domain->ip);
        assertNotEmpty($domain->id());
        assertNotEmpty($domain->createdAt());
    });

    test("creating an object with all the data", function () {
        $domain = new ClickShortLinkDomain(
            ip: $ip = 'testing',
            id: $id = Id::make(),
            createdAt: $createdAt = new DateTime(),
        );

        assertEquals($ip, $domain->ip);
        assertEquals($id, $domain->id);
        assertEquals($createdAt->format('Y-m-d H:i:s'), $domain->createdAt());
    });
});
