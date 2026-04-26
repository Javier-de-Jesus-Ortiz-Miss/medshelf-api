<?php

namespace App\Core\Product\Application\Dto\Request;

readonly class AddMedicalProductRequest
{
    public function __construct(
        public string $name,
        public string $description,
        public string $presentationType,
        public string $concentrationUnit,
        public float  $concentrationValue
    )
    {
    }
}
