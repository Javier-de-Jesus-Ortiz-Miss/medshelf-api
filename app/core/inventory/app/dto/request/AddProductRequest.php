<?php

namespace App\core\inventory\app\dto\request;

use DateTime;

readonly class AddProductRequest
{
    public function __construct(
        public string $brandName,
        public string $shape,
        public int $totalAmount,
        public string $unit,
        public array $substances,
        public DateTime $expirationDate
    ) {

    }
}
