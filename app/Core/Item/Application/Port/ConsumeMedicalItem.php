<?php

namespace App\Core\Item\Application\Port;

use App\Core\Item\Application\Dto\Request\ConsumeMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\ConsumptionResponse;

interface ConsumeMedicalItem
{
    public function execute(ConsumeMedicalItemRequest $request): ConsumptionResponse;
}
