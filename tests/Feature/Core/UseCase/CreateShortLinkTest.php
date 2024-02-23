<?php

use App\Models\ShortLink;
use Core\UseCase\CreateShortLink;
use Core\UseCase\DTO\ShortLinkOutput;

use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotEmpty;

beforeEach(fn () => $this->useCase = app(CreateShortLink::class));

test('CreateShortLink Feature Test', function () {
    $response = $this->useCase->execute(url: 'https://testing.com.br');
    assertInstanceOf(ShortLinkOutput::class, $response);
    assertEquals("https://testing.com.br", $response->url);
    assertNotEmpty($response->id);
    assertNotEmpty($response->created_at);

    assertEquals([
        'hash' => $response->hash,
        'date_expired_at' => $response->date_expired_at,
        'url' => $response->url,
        'total' => 0,
        'id' => $response->id,
        'created_at' => $response->created_at,
        'cache' => false,
    ], (array) $response);

    assertDatabaseHas(ShortLink::class, [
        'id' => $response->id,
        'created_at' => $response->created_at,
        'total' => 0,
        'url' => 'https://testing.com.br',
        'hash' => $response->hash,
        'date_expired_at' => $response->date_expired_at,
    ]);
});
