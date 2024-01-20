<?php

namespace Core\Shared\Interfaces;

interface PaginationOutputInterface
{
    public function __construct(
        array $items,
        int $total,
        int $last_page,
        int $first_page,
        int $current_page,
        int $per_page,
        int $to,
        int $from,
    );
}
