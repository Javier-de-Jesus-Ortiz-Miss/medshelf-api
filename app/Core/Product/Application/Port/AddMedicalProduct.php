<?php

namespace App\Core\Product\Application\Port;

use App\Core\Product\Application\Dto\Request\AddMedicalProductRequest;
use App\Core\Product\Application\Dto\Response\MedicalProductResponse;

interface AddMedicalProduct
{
    function execute(AddMedicalProductRequest $request): MedicalProductResponse;
}
