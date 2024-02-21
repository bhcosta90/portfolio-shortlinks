<?php

use App\Livewire\ShortLink;
use Livewire\Livewire;

it('ShortLink Feature Test', function () {
    $shortLink = \App\Models\ShortLink::factory()->create();

    Livewire::test(ShortLink::class, [$shortLink->id])
        ->assertStatus(200)
        ->assertSee(route('redirect', $shortLink->hash));
});
