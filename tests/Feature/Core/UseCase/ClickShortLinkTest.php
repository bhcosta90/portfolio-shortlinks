<?php

use App\Core\Repositories\Exception\ModelNotFoundException;
use App\Models\ShortLink;
use Core\Domain\Events\ClickEvent;
use Core\UseCase\ClickShortLink;
use Core\UseCase\DTO\ShortLinkOutput;

use Illuminate\Support\Facades\Event;

use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;

beforeEach(fn () => $this->useCase = app(ClickShortLink::class));

describe('ClickShortLink Feature Test', function () {
    test("success", function () {
        $shortLink = ShortLink::factory()->create();
        $response = $this->useCase->execute(hash: $shortLink->hash, ip: 'testing');
        assertInstanceOf(ShortLinkOutput::class, $response);
        assertDatabaseHas(\App\Models\ClickShortLink::class, [
            'short_link_id' => $shortLink->id,
            'ip' => 'testing',
        ]);
    });

    test("verify call the event", function () {
        Event::fake();

        $shortLink = ShortLink::factory()->create();
        $response = $this->useCase->execute(hash: $shortLink->hash, ip: 'testing');
        assertInstanceOf(ShortLinkOutput::class, $response);
        Event::assertDispatched(ClickEvent::class);
    });

    test("exception when hash is expired", function () {
        $shortLink = ShortLink::factory()->create(['date_expired_at' => now()->subMinute()]);
        expect(fn () => $this->useCase->execute(hash: $shortLink->hash, ip: 'testing'))->toThrow(new ModelNotFoundException($shortLink->hash, ShortLink::class));
    });

    test("exception when not found", function () {
        expect(fn () => $this->useCase->execute(hash: 'not-found', ip: 'testing'))->toThrow(new ModelNotFoundException('not-found', ShortLink::class));
    });

    test("get last short link when there are two equal hash", function () {
        $hashTime = "hash_" . time();

        ShortLink::factory()->create(['hash' => $hashTime, 'created_at' => now()->subMinutes(10)]);
        $shortLink = ShortLink::factory()->create(['hash' => $hashTime]);

        $response = $this->useCase->execute(hash: $hashTime, ip: 'testing');
        assertEquals($shortLink->id, $response->id);
    });

    test("get short link with cache", function () {
        $shortLink = ShortLink::factory()->create();
        $responseWithoutCache = $this->useCase->execute(hash: $shortLink->hash, ip: 'testing');
        $responseWithCache = $this->useCase->execute(hash: $shortLink->hash, ip: 'testing');
        assertFalse($responseWithoutCache->cache);
        assertTrue($responseWithCache->cache);
    });
});
