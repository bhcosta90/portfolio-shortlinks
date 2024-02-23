<?php

use App\Livewire\Home;
use App\Models\ShortLink;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

describe('HomeTest Feature Test', function () {
    test("success", function () {
        $livewire = livewire(Home::class)
            ->set('url', 'http://uol.com.br')
            ->call('submit');

        assertDatabaseHas(ShortLink::class, [
            'url' => 'http://uol.com.br',
        ]);

        $shortLink = ShortLink::first();

        $livewire->assertRedirect(route('short-link.show', $shortLink->id));
    });
});
