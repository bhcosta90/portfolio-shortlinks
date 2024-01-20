<?php

use App\Models\ShortLink;
use Core\Domain\Cache\ShortLinkCacheInterface;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\RedirectShortLink\RedirectShortLinkInput;
use Core\Domain\UseCases\RedirectShortLink;
use Core\Shared\Interfaces\PublishInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe("RedirectShortLink Feature Test", function () {
    test("Execute action", function () {
        $shortLink = ShortLink::factory()->create();

        $useCase = new RedirectShortLink(
            shotLinkRepository: app(ShotLinkRepositoryInterface::class),
            cache: app(ShortLinkCacheInterface::class),
            publish: app(PublishInterface::class),
        );

        $response = $useCase->execute(new RedirectShortLinkInput($shortLink->hash, "0.0.0.0"));
        expect($response->url)->toBe($shortLink->url);
    });
});
