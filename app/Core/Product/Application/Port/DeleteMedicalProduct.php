<?php

namespace App\Core\Product\Application\Port;

interface DeleteMedicalProduct
{
    public function execute(string $productId): void;
}
