<?php

use App\Models\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\Exception\ShortLinkNotFoundException;
use Core\Infra\UseCases\DTO\ShowShortLink\ShowShortLinkInput;
use Core\Infra\UseCases\ShowShortLinkUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertEquals;

uses(RefreshDatabase::class);

describe("ShowShortLinkUseCase Feature Test", function () {
    test("Action execute", function () {
        $shortLink = ShortLink::factory()->create();
        $useCase = new ShowShortLinkUseCase(
            shortLinkRepository: app(ShotLinkRepositoryInterface::class)
        );

        $response = $useCase->execute(new ShowShortLinkInput(hash: $shortLink->hash));
        assertEquals($shortLink->id, $response->id);
        assertEquals($shortLink->url, $response->endpoint);
        assertEquals($shortLink->total, $response->total);
    });

    test("Exception when do not exist short link", function () {
        $useCase = new ShowShortLinkUseCase(
            shortLinkRepository: app(ShotLinkRepositoryInterface::class)
        );

        expect(fn() => $useCase->execute(new ShowShortLinkInput(hash: "testing")))->toThrow(
            ShortLinkNotFoundException::class
        );
    });
});
