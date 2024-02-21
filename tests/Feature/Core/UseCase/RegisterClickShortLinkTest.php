<?php

use App\Core\Repositories\Exception\ModelNotFoundException;
use App\Models\ShortLink;
use Core\Domain\ClickShortLinkDomain;
use Core\UseCase\DTO\ClickShortLinkOutput;
use Core\UseCase\RegisterClickShortLink;

use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertInstanceOf;

beforeEach(fn () => $this->useCase = app(RegisterClickShortLink::class));

describe('RegisterClickShortLink Feature Test', function () {
    test("success", function () {
        $shortLink = ShortLink::factory()->create();
        $response = $this->useCase->execute($shortLink->id, new ClickShortLinkDomain(
            ip: 'testing',
        ));
        assertInstanceOf(ClickShortLinkOutput::class, $response);
        assertDatabaseHas(\App\Models\ClickShortLink::class, [
            'short_link_id' => $shortLink->id,
            'ip' => 'testing',
        ]);
    });

    test("exception when short link do not exist", function () {
        expect(fn () => $this->useCase->execute('not-found', new ClickShortLinkDomain(
            ip: 'testing',
        )))->toThrow(new ModelNotFoundException('not-found', ShortLink::class));
    });
});
