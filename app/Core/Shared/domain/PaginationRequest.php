<?php

namespace App\Core\Shared\Domain;

final readonly class PaginationRequest
{
    public function __construct(
        public int $page,
        public int $size
    )
    {
    }
}
