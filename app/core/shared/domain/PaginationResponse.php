<?php

namespace App\core\shared\domain;

final readonly class PaginationResponse
{
    public function __construct(
        public int   $totalCount,
        public int   $totalPages,
        public bool  $hasNextPage,
        public array $items = []
    )
    {
    }

    public function totalItems(): int
    {
        return count($this->items);
    }
}
