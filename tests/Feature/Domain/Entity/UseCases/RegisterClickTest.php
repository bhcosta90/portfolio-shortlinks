<?php

use App\Models\ShortLink;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\RegisterClick;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertTrue;

uses(RefreshDatabase::class);

describe("RegisterClick Unit Test", function () {
    test("Execute action", function () {
        $shortLink = ShortLink::factory()->create();

        $useCase = new RegisterClick(
            shotLinkRepository: app(ShotLinkRepositoryInterface::class),
        );

        $response = $useCase->execute(new \Core\Domain\UseCases\DTO\RegisterClickInput(id: $shortLink->id, ip: '0.0.0.0'));
        assertTrue($response->success);
    });
});