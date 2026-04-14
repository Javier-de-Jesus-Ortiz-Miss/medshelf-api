<?php

namespace App\core\item\app\dto\response;

use App\core\item\app\dto\data\InventoryResume;
use App\core\item\app\dto\data\ProductResume;
use Carbon\Carbon;

readonly class ItemViewResponse
{
    public function __construct(
        public string          $id,
        public ProductResume   $product,
        public InventoryResume $inventory,
        public int             $totalQuantity,
        public int             $quantity,
        public Carbon          $expirationDate,
        public Carbon          $addedDate
    )
    {
    }
}
