<?php

namespace App\Providers\Core\Item;

use App\Core\Item\Application\Dto\Data\MedicalProductResume;
use App\Core\Item\Application\Dto\Data\PlaceResume;
use App\Core\Item\Application\Dto\Response\MedicalItemViewResponse;
use App\Core\Item\Application\Port\MedicalItemReadRepository;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;
use App\Models\ItemModel;
use App\Services\PaginationService;
use Illuminate\Pagination\Cursor;

class MedicalItemReadRepositoryAdapter implements MedicalItemReadRepository
{

    function findById(string $id): ?MedicalItemViewResponse
    {
        $record = ItemModel::with([
            'product',
            'storage' => fn($q) => $q->select('id', 'public_id', 'place_id', 'name'),
            'storage.place' => fn($q) => $q->select('id', 'public_id', 'house_id', 'name'),
        ])
            ->where('public_id', $id)
            ->withSum('consumptions', 'amount')
            ->first();
        if (!$record) {
            return null;
        }
        return $this->toView($record);
    }

    private function toView(ItemModel $itemModel): MedicalItemViewResponse
    {
        $product = $itemModel->product;
        $place = $itemModel->storage->place;
        return new MedicalItemViewResponse(
            id: $itemModel->public_id,
            medicalProduct: new MedicalProductResume(
                id: $product->public_id,
                name: $product->name,
                description: $product->description,
                presentationType: $product->presentation_type,
                concentrationValue: $product->concentration_value,
                concentrationUnit: $product->concentration_unit
            ),
            place: new PlaceResume(
                id: $place->public_id,
                houseId: $place->house_id,
                name: $place->name
            ),
            totalQuantity: $itemModel->total_quantity,
            availableQuantity: $itemModel->total_quantity - ($itemModel->consumptions_sum_amount ?? 0),
            expirationDate: $itemModel->expiration_date,
            addedDate: $itemModel->created_at
        );
    }

    function listByPlaceIdByOffset(string $placeId, OffsetRequest $request): OffsetResponse
    {
        $result = ItemModel::with([
            'product' => fn($q) => $q->select('id', 'public_id', 'name'),
            'storage' => fn($q) => $q->select('id', 'public_id', 'house_id', 'name'),
        ])
            ->where('place_id', $placeId)
            ->withSum('consumptions', 'amount')
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

    function listByPlaceIdByCursor(string $placeId, CursorRequest $request): CursorResponse
    {
        $id = $request->cursor
            ? ItemModel::where('public_id', $request->cursor)->value('id')
            : null;
        $laravelCursor = $id ? new Cursor(['id' => $id])
            : null;
        return PaginationService::buildCursorQuery(
            query: ItemModel::with([
                'product' => fn($q) => $q->select('id', 'public_id', 'name'),
                'storage' => fn($q) => $q->select('id', 'public_id', 'house_id', 'name'),
            ])
                ->where('place_id', $placeId)
                ->withSum('consumptions', 'amount')
                ->orderBy('id'),
            cursor: $laravelCursor,
            size: $request->size,
            mapper: fn($item) => $this->toView($item)
        );
    }
}
