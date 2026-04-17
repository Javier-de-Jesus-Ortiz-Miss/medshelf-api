<?php

namespace App\Core\Product\Application\Port;

use App\Core\Product\Application\Dto\Request\AddProductRequest;
use App\Core\Product\Application\Dto\Response\ProductResponse;

interface AddProduct
{
    function execute(AddProductRequest $request): ProductResponse;
}
