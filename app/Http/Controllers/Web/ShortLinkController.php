<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Presenters\PaginationPresenter;
use App\Http\Requests\Api\RegisterRequestStore;
use Core\Infra\UseCases\DTO\HistoryShortLink\HistoryShortLinkInput;
use Core\Infra\UseCases\DTO\RegisterShortLink\RegisterShortLinkInput;
use Core\Infra\UseCases\DTO\ShowShortLink\ShowShortLinkInput;
use Core\Infra\UseCases\HistoryShortLinkUseCase;
use Core\Infra\UseCases\RegisterShortLinkUseCase;
use Core\Infra\UseCases\ShowShortLinkUseCase;

use function redirect;
use function route;

class ShortLinkController extends Controller
{
    public function store(RegisterRequestStore $registerRequestStore, RegisterShortLinkUseCase $registerShortLink)
    {
        $response = $registerShortLink->execute(new RegisterShortLinkInput(url: $registerRequestStore->endpoint));
        return redirect()->route('w.short-link.show', ['id' => $response->id]);
    }

    public function show(ShowShortLinkUseCase $showShortLink, string $id, HistoryShortLinkUseCase $historyShortLink)
    {
        $response = $showShortLink->execute(new ShowShortLinkInput(id: $id));

        return view(
            'short-link.show',
            (array)$response + [
                'hash' => $hash = $response->hash,
                'url' => route('a.short-link.show', ['hash' => $hash]),
                'histories' => PaginationPresenter::render(
                    $historyShortLink->execute(new HistoryShortLinkInput(page: request('page', 1), id: $id))
                )
            ]
        );
    }
}
