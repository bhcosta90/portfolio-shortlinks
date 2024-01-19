<?php

use App\Models\ShortLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe("ShortLinkController Feature Test", function () {
    test("Action store", function () {
        $shortLink = ShortLink::factory()->create();
        get('/' . $shortLink->hash)->assertStatus(302);
    });
});
