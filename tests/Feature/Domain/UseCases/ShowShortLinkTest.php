<?php

use App\Models\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\ShowShortLink\ShowShortLinkInput;
use Core\Domain\UseCases\ShowShortLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertEquals;

uses(RefreshDatabase::class);

describe("ShowShortLink Feature Test", function () {
    test("Action execute", function () {
        $shortLink = ShortLink::factory()->create();
        $useCase = new ShowShortLink(
            shortLinkRepository: app(ShotLinkRepositoryInterface::class)
        );

        $response = $useCase->execute(new ShowShortLinkInput(hash: $shortLink->hash));
        assertEquals($shortLink->id, $response->id);
        assertEquals($shortLink->url, $response->endpoint);
        assertEquals($shortLink->total, $response->total);
    });
});
