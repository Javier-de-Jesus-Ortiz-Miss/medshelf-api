<?php

namespace App\Core\Product\Application\Dto\Response;

use App\Core\Shared\Domain\PaginableByCursor;
use Carbon\Carbon;

readonly class MedicalProductResponse implements PaginableByCursor
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $presentationType,
        public string $concentrationUnit,
        public float  $concentrationValue,
        public Carbon $addedDate
    )
    {
    }

    public function getCursor(): string
    {
        return $this->id;
    }
}
