<?php

namespace App\core\product\app\port;

use App\core\product\app\dto\request\AddProductRequest;
use App\core\product\app\dto\response\ProductResponse;

interface AddProduct
{
    function execute(AddProductRequest $request): ProductResponse;
}
