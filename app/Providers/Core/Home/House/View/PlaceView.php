<?php

namespace App\Providers\Core\Home\House\View;

use App\Core\Shared\Domain\PaginableByCursor;

readonly class PlaceView implements PaginableByCursor
{
    public function __construct(
        public string $id,
        public string $name,
    )
    {
    }

    public function getCursor(): string
    {
        return $this->id;
    }
}