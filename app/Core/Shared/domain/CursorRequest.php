<?php

namespace App\Core\Shared\Domain;

readonly class CursorRequest
{
    public function __construct(
        public string $cursor,
        public int    $limit
    )
    {
    }
}
