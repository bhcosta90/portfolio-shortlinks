<?php

namespace Core\Infra\UseCases;

use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\UseCases\DTO\HistoryShortLink\HistoryShortLinkInput;
use Core\Infra\UseCases\DTO\HistoryShortLink\HistoryShortLinkOutput;

readonly class HistoryShortLinkUseCase
{
    public function __construct(
        protected ShotLinkRepositoryInterface $shortLinkRepository,
    ) {
        //
    }

    public function execute(HistoryShortLinkInput $input): HistoryShortLinkOutput{
        $shortLink = $this->shortLinkRepository->findShortLinkById($input->id);
        $data = $this->shortLinkRepository->paginateHistoriesByShortLink($input->page, $shortLink);
        return new HistoryShortLinkOutput(
            items: $data->items(),
            total: $data->total(),
            last_page: $data->lastPage(),
            first_page: $data->firstPage(),
            current_page: $data->currentPage(),
            per_page: $data->perPage(),
            to: $data->to(),
            from: $data->from(),
        );
    }
}
