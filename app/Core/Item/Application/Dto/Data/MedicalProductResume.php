<?php

namespace App\Core\Item\Application\Dto\Data;

readonly class MedicalProductResume
{
    public function __construct(
        public string           $id,
        public string           $name,
        public string           $description,
        public string           $presentationType,
        public ConcentrationDto $concentration
    )
    {
    }
}
