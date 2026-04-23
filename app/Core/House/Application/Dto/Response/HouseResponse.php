<?php

namespace App\Core\House\Application\Dto\Response;

use Carbon\Carbon;

readonly class HouseResponse
{
    public function __construct(
        public string $id,
        public string $ownerId,
        public string $name,
        public Carbon $createdAt
    )
    {
    }
}
