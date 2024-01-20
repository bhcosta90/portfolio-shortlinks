<?php

use App\Models\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\Cache\ShortLinkCacheInterface;
use Core\Infra\Exception\ShortLinkNotFoundException;
use Core\Infra\UseCases\DTO\RedirectShortLink\RedirectShortLinkInput;
use Core\Infra\UseCases\RedirectShortLinkUseCase;
use Core\Shared\Interfaces\PublishInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe("RedirectShortLinkUseCase Feature Test", function () {
    test("Execute action", function () {
        $shortLink = ShortLink::factory()->create();

        $useCase = new RedirectShortLinkUseCase(
            shortLinkRepository: app(ShotLinkRepositoryInterface::class),
            cache: app(ShortLinkCacheInterface::class),
            publish: app(PublishInterface::class),
        );

        $response = $useCase->execute(new RedirectShortLinkInput($shortLink->hash, "0.0.0.0"));
        expect($response->url)->toBe($shortLink->url);
    });

    test("Exception when short link do not exist", function () {
        $useCase = new RedirectShortLinkUseCase(
            shortLinkRepository: app(ShotLinkRepositoryInterface::class),
            cache: app(ShortLinkCacheInterface::class),
            publish: app(PublishInterface::class),
        );

        expect(fn() => $useCase->execute(new RedirectShortLinkInput("testing", "0.0.0.0")))->toThrow(
            ShortLinkNotFoundException::class
        );
    });
});
