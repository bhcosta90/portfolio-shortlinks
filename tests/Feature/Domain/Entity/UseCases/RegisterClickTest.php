<?php

use App\Models\ShortLink;
use Core\Domain\Cache\ShortLinkCacheInterface;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\RegisterClickInput;
use Core\Domain\UseCases\RegisterClick;
use Core\Shared\Interfaces\PublishInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe("RegisterClick Feature Test", function () {
    test("Execute action", function () {
        $shortLink = ShortLink::factory()->create();

        $useCase = new RegisterClick(
            shotLinkRepository: app(ShotLinkRepositoryInterface::class),
            cache: app(ShortLinkCacheInterface::class),
            publish: app(PublishInterface::class),
        );

        $response = $useCase->execute(new RegisterClickInput($shortLink->hash, "0.0.0.0"));
        dump($response);
    });
});
