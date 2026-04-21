<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Request\ConsumeMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\MedicalItemResponse;

interface ConsumeMedicalItem
{
    public function execute(ConsumeMedicalItemRequest $request): MedicalItemResponse;
}
