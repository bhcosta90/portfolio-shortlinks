<?php

use App\Models\ShortLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

describe("RegisterController Feature Test", function(){
    test("Action store", function(){
        $response = postJson('api/register', [
            'endpoint' => 'http://google.com.br',
        ]);

        assertDatabaseHas(ShortLink::class, [
            'id' => $response->json('data.id'),
        ]);
    });
});
