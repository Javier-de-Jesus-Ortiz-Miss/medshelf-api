<?php

namespace App\Providers\Core\Home\Item\View;

use App\Core\Shared\Domain\PaginableByCursor;
use App\Providers\Core\Home\Item\Resume\ProductResume;

readonly class ItemView implements PaginableByCursor
{
    public function __construct(
        public string        $id,
        public ProductResume $product,
        public string        $expirationDate,
    )
    {
    }

    public function getCursor(): string
    {
        return $this->id;
    }
}