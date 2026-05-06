<?php

namespace App\Core\Catalog\Product\Application\Exception;

use App\Core\Shared\Application\AppException;

class ActiveIngredientNotFound extends AppException
{
    public function __construct(string $name)
    {
        parent::__construct("Active ingredient '$name' does not exist.");
    }
}