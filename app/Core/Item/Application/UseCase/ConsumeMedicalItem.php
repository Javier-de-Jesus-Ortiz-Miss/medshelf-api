<?php

namespace App\Core\Item\Application\UseCase;

use App\Core\Item\Application\Dto\Request\ConsumeMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\ConsumptionResponse;
use App\Core\Item\Application\Mapping\MedicalItemMapper;
use App\Core\Item\Model\MedicalItemRepository;
use InvalidArgumentException;

final readonly class ConsumeMedicalItem
{
    public function __construct(
        private MedicalItemRepository $repository
    )
    {
    }

    public function execute(ConsumeMedicalItemRequest $request): ConsumptionResponse
    {
        $item = $this->repository->findById($request->medicalItemId) ??
            throw new InvalidArgumentException("Item with id $request->medicalItemId not found");
        $consumption = $item->consume($request->amount);
        $this->repository->consume($consumption);
        return MedicalItemMapper::toConsumptionResponse($consumption);
    }
}
