<?php

use App\Models\ShortLink;
use App\Models\ShortLinkHistory;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\UseCases\DTO\RegisterClick\RegisterClickInput;
use Core\Infra\UseCases\RegisterClickUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseCount;
use function PHPUnit\Framework\assertTrue;

uses(RefreshDatabase::class);

describe("RegisterClickUseCase Unit Test", function () {
    test("Execute action", function () {
        $shortLink = ShortLink::factory()->create();

        $useCase = new RegisterClickUseCase(
            shotLinkRepository: app(ShotLinkRepositoryInterface::class),
        );

        $response = $useCase->execute(
            new RegisterClickInput(
                id: $shortLink->id,
                ip: '0.0.0.0',
                createdAt: new DateTime(),
            )
        );
        assertTrue($response->success);
        assertDatabaseCount(ShortLinkHistory::class, 1);
    });
});
