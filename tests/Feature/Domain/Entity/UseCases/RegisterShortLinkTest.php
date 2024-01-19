<?php

use Core\Domain\Cache\ShortLinkCacheInterface;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\RegisterShortLinkInput;
use Core\Domain\UseCases\RegisterShortLink;
use Core\Shared\Interfaces\DatabaseInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

describe("RegisterShortLink Feature Test", function () {
    test("Execute action", function () {
        $useCase = new RegisterShortLink(
            shotLinkRepository: app(ShotLinkRepositoryInterface::class),
            database: app(DatabaseInterface::class),
            cache: app(ShortLinkCacheInterface::class)
        );

        $response = $useCase->execute(new RegisterShortLinkInput(url: "http://google.com"));
        assertDatabaseHas('short_links', [
            'id' => $response->id,
        ]);
    });
});
