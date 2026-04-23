<?php

namespace App\Core\House\Application\Dto\Response;

use App\Core\House\Application\Dto\Data\OwnerResume;
use Carbon\Carbon;

readonly class HouseViewResponse
{
    public function __construct(
        public string      $id,
        public OwnerResume $owner,
        public string      $name,
        public Carbon      $createdAt
    )
    {
    }
}
