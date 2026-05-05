<?php

namespace App\Core\Home\House\Application\Dto\Response;

use Carbon\Carbon;

readonly class PlaceResponse
{
    public function __construct(
        public string $id,
        public string $houseId,
        public string $name,
        public Carbon $createdAt,
    )
    {
    }
}
