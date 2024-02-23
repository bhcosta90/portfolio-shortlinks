<?php

declare(strict_types=1);

use Core\Domain\ValueObject\Code;
use Core\Domain\ClickShortLinkDomain;
use Core\Domain\ShortLinkDomain;
use Shared\ValueObject\Id;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertNotEquals;

describe("ShortLinkDomain Unit Test", function () {
    test("creating the object with minimal data", function () {
        $domain = new ShortLinkDomain(
            url: 'testing',
        );

        assertEquals('testing', $domain->url);
        assertNotEmpty($domain->dateExpiredAt);
        assertNotEmpty($domain->hash);
        assertEquals(0, $domain->total);
        assertNotEmpty($domain->id());
        assertNotEmpty($domain->createdAt());
        assertNotEquals((new DateTime())->format('Y-m-d'), new DateTime($domain->dateExpiredAt->format('Y-m-d')));
    });

    test("creating an object with all the data", function () {
        $domain = new ShortLinkDomain(
            url: $url = 'testing',
            dateExpiredAt: $dateExpiredAt = new DateTime(),
            total: $total = 10,
            hash: $hash = new Code('hash'),
            id: $id = Id::make(),
            createdAt: $createdAt = new DateTime(),
        );

        assertEquals($url, $domain->url);
        assertEquals($dateExpiredAt, $domain->dateExpiredAt);
        assertEquals($total, $domain->total);
        assertEquals($hash, $domain->hash);
        assertEquals($id, $domain->id);
        assertEquals($createdAt->format('Y-m-d H:i:s'), $domain->createdAt());
    });

    test("action addClick", function () {
        $mockClickShortLinkDomain = Mockery::mock(ClickShortLinkDomain::class, ['123456789']);

        $domain = new ShortLinkDomain(
            url: 'testing',
        );

        assertCount(0, $domain->clicks);
        assertEquals(0, $domain->total);
        $domain->addClick($mockClickShortLinkDomain);
        assertCount(1, $domain->clicks);
        assertEquals(1, $domain->total);
    });
});
