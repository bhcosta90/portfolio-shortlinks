<?php

use App\Http\Controllers\Web\ShortLinkController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('w.home');
Route::post('/register', [ShortLinkController::class, 'store'])->name('w.register');
Route::get('/short-link/{id}', [ShortLinkController::class, 'show'])->name('w.short-link.show');
