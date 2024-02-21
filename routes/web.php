<?php

use App\Livewire\Home;
use App\Livewire\ShortLink;
use Core\UseCase\ClickShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Home::class);
Route::get('/{id}', ShortLink::class)->name('short-link.show');
Route::get('/r/{hash}', function (string $hash, ClickShortLink $clickShortLink, Request $request) {
    $response = $clickShortLink->execute(
        hash: $hash,
        ip: $request->ip()
    );

    return redirect($response->url);
})->name('redirect');
