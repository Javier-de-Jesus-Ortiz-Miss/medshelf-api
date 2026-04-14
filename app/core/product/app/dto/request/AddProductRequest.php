<?php

namespace App\core\product\app\dto\request;

readonly class AddProductRequest
{
    public function __construct(
        public string $name,
        public string $description,
        public string $presentationType,
        public string $concentrationUnit,
        public int    $concentrationValue
    )
    {
    }
}
