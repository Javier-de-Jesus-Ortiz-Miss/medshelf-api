<?php

namespace App\core\product\app\dto\response;

use Carbon\Carbon;

readonly class ProductResponse
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $presentationType,
        public string $concentrationUnit,
        public int    $concentrationValue,
        public Carbon $addedDate
    )
    {
    }
}
