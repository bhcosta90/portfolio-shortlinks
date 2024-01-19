<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequestStore;
use App\Http\Resources\ShortLinkResource;
use Core\Domain\UseCases\DTO\RegisterClickInput;
use Core\Domain\UseCases\DTO\RegisterShortLinkInput;
use Core\Domain\UseCases\RegisterClick;
use Core\Domain\UseCases\RegisterShortLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function redirect;

class ShortLinkController extends Controller
{
    public function store(RegisterRequestStore $registerRequestStore, RegisterShortLink $registerShortLink): ShortLinkResource
    {
        $response = $registerShortLink->execute(new RegisterShortLinkInput(url: $registerRequestStore->endpoint));
        return new ShortLinkResource($response);
    }

    public function show(string $hash, RegisterClick $registerClick, Request $request): RedirectResponse
    {
        $response = $registerClick->execute(new RegisterClickInput(hash: $hash, ip: $request->ip()));
        return redirect($response->url);
    }
}
