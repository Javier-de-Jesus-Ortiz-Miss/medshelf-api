<?php

namespace App\Providers\Core\Home\House\Detail;

use App\Providers\Core\Home\House\Resume\OwnerResume;

readonly class HouseDetail
{
    public function __construct(
        public string      $id,
        public OwnerResume $owner,
        public string      $name,
        public string      $createdAt,
    )
    {
    }
}