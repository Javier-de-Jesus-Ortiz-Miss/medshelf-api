<?php

namespace App\Core\Shared\Domain;

readonly class OffsetResponse
{
    public function __construct(
        public int   $totalCount,
        public int   $limit,
        public int   $offset,
        public bool  $hasNextPage,
        public array $items = []
    )
    {
    }
}
