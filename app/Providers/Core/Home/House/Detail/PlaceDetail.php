<?php

namespace App\Providers\Core\Home\House\Detail;

use App\Providers\Core\Home\House\Resume\HouseResume;

readonly class PlaceDetail
{
    public function __construct(
        public string      $id,
        public HouseResume $house,
        public string      $name,
        public string      $createdAt,
    )
    {
    }
}