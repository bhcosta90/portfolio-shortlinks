<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Domain\UseCases\DTO\RegisterClickInput;
use Core\Domain\UseCases\RegisterClick;
use Illuminate\Http\Request;

use function redirect;

class ShortLinkController extends Controller
{
    public function show(string $hash, RegisterClick $registerClick, Request $request)
    {
        $response = $registerClick->execute(new RegisterClickInput(hash: $hash, ip: $request->ip()));
        return redirect($response->url);
    }
}
