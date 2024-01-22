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

        $response = $useCase->execute(new ShowShortLinkInput(id: $shortLink->id));
        assertEquals($shortLink->hash, $response->hash);
        assertEquals($shortLink->url, $response->endpoint);
        assertEquals($shortLink->total, $response->total);
    });
});
