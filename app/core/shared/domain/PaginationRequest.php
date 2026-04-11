<?php

namespace App\core\shared\domain;

final readonly class PaginationRequest
{
    public function __construct(
        public int $page,
        public int $size
    )
    {
    }
}
