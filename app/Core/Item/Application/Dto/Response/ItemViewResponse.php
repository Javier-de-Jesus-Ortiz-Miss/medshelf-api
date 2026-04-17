<?php

namespace App\Core\Item\Application\Dto\Response;

use App\Core\Item\Application\Dto\Data\ProductResume;
use App\Core\Item\Application\Dto\Data\StorageUnitResume;
use Carbon\Carbon;

readonly class ItemViewResponse
{
    public function __construct(
        public string            $id,
        public ProductResume     $product,
        public StorageUnitResume $inventory,
        public int               $totalQuantity,
        public int               $quantity,
        public Carbon            $expirationDate,
        public Carbon            $addedDate
    )
    {
    }
}
