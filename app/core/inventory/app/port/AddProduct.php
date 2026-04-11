<?php

namespace App\core\inventory\app\port;

use App\core\inventory\app\dto\request\AddProductRequest;
use App\core\inventory\app\dto\response\ProductResponse;

interface AddProduct
{
    public function execute(AddProductRequest $request): ProductResponse;
}
