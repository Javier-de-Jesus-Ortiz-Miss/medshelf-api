<?php

namespace App\Providers\Core\Home\House\View;

readonly class PlaceView
{
    public function __construct(
        public string $id,
        public string $name,
    )
    {
    }
}