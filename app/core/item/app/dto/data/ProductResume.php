<?php

namespace App\core\item\app\dto\data;

readonly class ProductResume
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $presentationType,
        public string $concentration
    )
    {
    }
}
