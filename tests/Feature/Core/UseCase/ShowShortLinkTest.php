<?php

use App\Core\Repositories\Exception\ModelNotFoundException;
use App\Models\ShortLink;
use Core\UseCase\ShowShortLink;

use function PHPUnit\Framework\assertEquals;

beforeEach(fn () => $this->useCase = app(ShowShortLink::class));

describe("ShowShortLink Feature Test", function () {
    test('success', function () {
        $shortLink = ShortLink::factory()->create();

        $response = $this->useCase->execute(id: $shortLink->id);
        assertEquals([
            'hash' => $response->hash,
            'date_expired_at' => $response->date_expired_at,
            'url' => $response->url,
            'total' => 0,
            'id' => $response->id,
            'created_at' => $response->created_at,
            'cache' => false,
        ], (array) $response);
    });

    test("exception when do not exist short link", function () {
        expect(fn () => $this->useCase->execute(id: 'not-found'))->toThrow(new ModelNotFoundException("not-found", ShortLink::class));
    });
});
