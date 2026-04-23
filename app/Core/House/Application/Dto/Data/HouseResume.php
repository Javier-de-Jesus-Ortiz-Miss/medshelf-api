<?php

namespace App\Core\House\Application\Dto\Data;

readonly class HouseResume
{
    public function __construct(
        public string $id,
        public string $name
    )
    {

    }
}
