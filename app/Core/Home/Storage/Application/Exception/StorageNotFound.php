<?php

namespace App\Core\Home\Storage\Application\Exception;

use App\Core\Shared\Application\AppException;

class StorageNotFound extends AppException
{
    public function __construct(string $placeId)
    {
        parent::__construct("Storage unit for place with id $placeId not found");
    }
}