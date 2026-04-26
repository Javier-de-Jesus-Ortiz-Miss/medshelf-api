<?php

namespace App\Providers\Core\Item;

use App\Core\Item\Application\Dto\Data\MedicalItemResume;
use App\Core\Item\Application\Dto\Response\ConsumptionViewResponse;
use App\Core\Item\Application\Port\ConsumptionReadRepository;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;
use App\Models\ConsumptionModel;
use App\Services\PaginationService;
use Illuminate\Pagination\Cursor;
use InvalidArgumentException;

class ConsumptionReadRepositoryAdapter implements ConsumptionReadRepository
{
    public function findById(string $id): ConsumptionViewResponse
    {
        $record = ConsumptionModel::with('item')
            ->where('public_id', $id)
            ->withSum('item.consumptions', 'amount')
            ->first();
        if (!$record) {
            throw new InvalidArgumentException("Consumption with id $id not found");
        }
        return $this->toView($record);
    }

    private function toView(ConsumptionModel $consumptionModel): ConsumptionViewResponse
    {
        $item = $consumptionModel->item;
        $availableQuantity = $item->total_quantity - ($item->consumptions_sum_amount ?? 0);
        return new ConsumptionViewResponse(
            id: $consumptionModel->public_id,
            medicalItem: new MedicalItemResume(
                id: $item->public_id,
                medicalProductId: $item->product->public_id,
                storageUnitId: $item->storage->public_id,
                totalQuantity: $item->total_quantity,
                availableQuantity: $availableQuantity,
                expirationDate: $item->expiration_date,
                addedDate: $item->created_at
            ),
            amount: $consumptionModel->amount,
            consumptionDate: $consumptionModel->consumed_at
        );
    }

    public function listByItemIdByOffset(string $itemId, OffsetRequest $request): OffsetResponse
    {
        $result = ConsumptionModel::with('item')
            ->whereHas('item', fn($query) => $query->where('public_id', $itemId))
            ->withSum('item.consumptions', 'amount')
            ->orderBy('id')
            ->paginate(perPage: $request->size, page: $request->cursor);
        return new OffsetResponse(
            totalCount: $result->total(),
            page: $request->cursor,
            size: $request->size,
            hasNextPage: $result->hasMorePages(),
            items: collect($result->items())
                ->map(fn($item) => $this->toView($item))
                ->toArray()
        );
    }

    public function listByItemIdByCursor(string $itemId, CursorRequest $request): CursorResponse
    {
        $id = $request->cursor
            ? ConsumptionModel::where('public_id', $request->cursor)->value('id')
            : null;
        $laravelCursor = $id ? new Cursor(['id' => $id])
            : null;
        return PaginationService::buildCursorQuery(
            query: ConsumptionModel::with('item')
                ->whereHas('item', fn($query) => $query->where('public_id', $itemId))
                ->withSum('item.consumptions', 'amount')
                ->orderBy('id'),
            cursor: $laravelCursor,
            size: $request->size,
            mapper: fn($item) => $this->toView($item)
        );
    }
}
