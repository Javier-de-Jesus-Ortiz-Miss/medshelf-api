<?php

namespace App\Core\Catalog\Product\Application\Exception;

use App\Core\Shared\Application\AppException;

class PharmaceuticalFormNotFound extends AppException
{
    public function __construct(string $name)
    {
        parent::__construct("Pharmaceutical form '$name' not found.");
    }
}