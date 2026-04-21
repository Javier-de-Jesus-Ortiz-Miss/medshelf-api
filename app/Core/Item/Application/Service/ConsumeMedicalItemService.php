<?php

namespace App\Core\Item\Application\Service;

use App\Core\Item\Application\Dto\Request\ConsumeMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\MedicalItemResponse;
use App\Core\Item\Application\Mapping\MedicalItemMapper;
use App\Core\Item\Application\Port\ConsumeMedicalItem;
use App\Core\Item\Model\MedicalItemRepository;
use InvalidArgumentException;

final readonly class ConsumeMedicalItemService implements ConsumeMedicalItem
{
    public function __construct(
        private MedicalItemRepository $repository
    )
    {
    }

    public function execute(ConsumeMedicalItemRequest $request): MedicalItemResponse
    {
        $item = $this->repository->findById($request->medicalItemId) ??
            throw new InvalidArgumentException("Item with id $request->medicalItemId not found");
        $item->consume($request->quantity);
        $this->repository->save($item);
        return MedicalItemMapper::toItemResponse($item);
    }
}
