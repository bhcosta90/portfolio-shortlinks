<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequestStore;
use Core\Domain\UseCases\DTO\RegisterShortLinkInput;
use Core\Domain\UseCases\DTO\ShowShortLinkInput;
use Core\Domain\UseCases\RegisterShortLink;

use Core\Domain\UseCases\ShowShortLink;

use function redirect;

class ShortLinkController extends Controller
{
    public function store(RegisterRequestStore $registerRequestStore, RegisterShortLink $registerShortLink)
    {
        $response = $registerShortLink->execute(new RegisterShortLinkInput(url: $registerRequestStore->endpoint));
        return redirect()->route('w.short-link.show', ['hash' => $response->hash]);
    }

    public function show(ShowShortLink $showShortLink, string $hash){
        $response = $showShortLink->execute(new ShowShortLinkInput(hash: $hash));
        $url = route('a.short-link.show', ['hash' => $hash]);
        return view('short-link.show', (array) $response + ['hash' => $hash, 'url' => $url]);
    }
}
