<?php

namespace App\Core\Home\Item\Application\Exception;

use App\Core\Shared\Application\AppException;

class ItemNotFound extends AppException
{
    public function __construct(string $itemId)
    {
        parent::__construct('Item not found for id: ' . $itemId);
    }
}