<?php

namespace Core\Domain\UseCases;

use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Domain\UseCases\DTO\HistoryShortLink\HistoryShortLinkInput;
use Core\Domain\UseCases\DTO\HistoryShortLink\HistoryShortLinkOutput;

readonly class HistoryShortLink
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
