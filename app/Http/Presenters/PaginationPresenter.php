<?php

namespace App\Http\Presenters;

use Core\Shared\Interfaces\PaginationOutputInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginationPresenter
{
    public static function render(PaginationOutputInterface $input): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            $input->items,
            $input->total,
            $input->per_page,
            $input->current_page,
            [
                'path' => Paginator::resolveCurrentPath()
            ]
        );
    }
}
