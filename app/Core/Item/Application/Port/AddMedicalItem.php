<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Request\AddMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\MedicalItemResponse;

interface AddMedicalItem
{
    public function execute(AddMedicalItemRequest $request): MedicalItemResponse;
}
