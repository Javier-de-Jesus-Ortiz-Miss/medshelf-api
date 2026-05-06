<?php

namespace App\Providers\Core\Home\Item\View;

use App\Core\Shared\Domain\PaginableByCursor;

readonly class ConsumptionView implements PaginableByCursor
{
    public function __construct(
        public string $id,
        public float  $amount,
        public string $consumedAt
    )
    {
    }

    public function getCursor(): string
    {
        return $this->id;
    }
}