<?php

namespace App\Providers\Core\Home\Item\Resume;

readonly class PlaceResume
{
    public function __construct(
        public string $id,
        public string $name,
    )
    {
    }
}