<?php

namespace App\core\inventory\app\dto\response;

readonly class ProductResponse
{
    public function __construct(
        public string $id,
        public string $brandName,
        public array $substances,
        public string $shape,
        public int $totalAmount,
        public string $unit,
        public int $actualQuantity,
        public string $expirationDate,
        public string $status,
        public string $addedDate
    ) {

    }
}
