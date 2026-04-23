<?php

namespace App\Core\House\Application\Dto\Response;

use App\Core\House\Application\Dto\Data\HouseResume;

readonly class PlaceViewResponse
{
    public function __construct(
        public string      $id,
        public HouseResume $house,
        public string      $name
    )
    {
    }
}
