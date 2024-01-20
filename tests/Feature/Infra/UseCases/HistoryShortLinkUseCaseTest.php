<?php

use App\Models\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\UseCases\DTO\HistoryShortLink\HistoryShortLinkInput;
use Core\Infra\UseCases\HistoryShortLinkUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

uses(RefreshDatabase::class);

describe("HistoryShortLinkUseCase Feature Test", function () {
    test("Action execute", function () {
        $shortLink = ShortLink::factory()->hasClicks(50)->create();
        $useCase = new HistoryShortLinkUseCase(
            shortLinkRepository: app(ShotLinkRepositoryInterface::class)
        );

        $response = $useCase->execute(new HistoryShortLinkInput(page: 1, id: $shortLink->id));
        assertEquals(4, $response->last_page);
        assertEquals(1, $response->first_page);
        assertEquals(1, $response->current_page);
        assertEquals(15, $response->from);
        assertEquals(1, $response->to);
        assertEquals(50, $response->total);
        assertCount(15, $response->items);

        $response = $useCase->execute(new HistoryShortLinkInput(page: 2, id: $shortLink->id));
        assertEquals(4, $response->last_page);
        assertEquals(16, $response->first_page);
        assertEquals(2, $response->current_page);
        assertEquals(30, $response->from);
        assertEquals(16, $response->to);
        assertEquals(50, $response->total);
    });
});
