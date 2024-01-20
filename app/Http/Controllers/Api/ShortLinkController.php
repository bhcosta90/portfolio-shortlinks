<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequestStore;
use App\Http\Resources\ShortLinkResource;
use Core\Infra\UseCases\DTO\RedirectShortLink\RedirectShortLinkInput;
use Core\Infra\UseCases\DTO\RegisterShortLink\RegisterShortLinkInput;
use Core\Infra\UseCases\RedirectShortLinkUseCase;
use Core\Infra\UseCases\RegisterShortLinkUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function redirect;

class ShortLinkController extends Controller
{
    public function store(RegisterRequestStore $registerRequestStore, RegisterShortLinkUseCase $registerShortLink): ShortLinkResource
    {
        $response = $registerShortLink->execute(new RegisterShortLinkInput(url: $registerRequestStore->endpoint));
        return new ShortLinkResource($response);
    }

    public function show(string $hash, RedirectShortLinkUseCase $registerClick, Request $request): RedirectResponse
    {
        $response = $registerClick->execute(new RedirectShortLinkInput(hash: $hash, ip: $request->ip()));
        if (!isset($request->debug)) {
            return redirect($response->url);
        }
        dd($response);
    }
}
