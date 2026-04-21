<?php

namespace App\Core\Shared\Domain;

readonly class OffsetRequest
{
    public function __construct(
        public int $offset,
        public int $limit
    )
    {
    }
}
