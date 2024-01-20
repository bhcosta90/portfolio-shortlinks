<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Presenters\PaginationPresenter;
use App\Http\Requests\Api\RegisterRequestStore;
use Core\Domain\UseCases\DTO\HistoryShortLink\HistoryShortLinkInput;
use Core\Domain\UseCases\DTO\RegisterShortLink\RegisterShortLinkInput;
use Core\Domain\UseCases\DTO\ShowShortLink\ShowShortLinkInput;
use Core\Domain\UseCases\HistoryShortLink;
use Core\Domain\UseCases\RegisterShortLink;
use Core\Domain\UseCases\ShowShortLink;

use function redirect;
use function route;

class ShortLinkController extends Controller
{
    public function store(RegisterRequestStore $registerRequestStore, RegisterShortLink $registerShortLink)
    {
        $response = $registerShortLink->execute(new RegisterShortLinkInput(url: $registerRequestStore->endpoint));
        return redirect()->route('w.short-link.show', ['hash' => $response->hash]);
    }

    public function show(ShowShortLink $showShortLink, string $hash, HistoryShortLink $historyShortLink)
    {
        $response = $showShortLink->execute(new ShowShortLinkInput(hash: $hash));
        return view(
            'short-link.show',
            (array)$response + [
                'hash' => $hash,
                'url' => route('a.short-link.show', ['hash' => $hash]),
                'histories' => PaginationPresenter::render(
                    $historyShortLink->execute(new HistoryShortLinkInput(page: request('page', 1), id: $response->id))
                )
            ]
        );
    }
}
