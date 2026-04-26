<?php

namespace App\Providers\Core\Product;

use App\Core\Product\Application\Dto\Response\MedicalProductResponse;
use App\Core\Product\Application\Port\MedicalProductReadRepository;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;
use App\Models\ProductModel;
use App\Services\PaginationService;
use Illuminate\Pagination\Cursor;

class MedicalProductReadRepositoryAdapter implements MedicalProductReadRepository
{

    function findById(string $id): ?MedicalProductResponse
    {
        $record = ProductModel::where('public_id', $id)->first();
        if (!$record) return null;
        return $this->toResponse($record);
    }

    private function toResponse(ProductModel $record): MedicalProductResponse
    {
        return new MedicalProductResponse(
            id: $record->public_id,
            name: $record->name,
            description: $record->description,
            presentationType: $record->presentation_type,
            concentrationUnit: $record->concentration_unit,
            concentrationValue: $record->concentration_value,
            addedDate: $record->created_at
        );
    }

    function listByOffset(OffsetRequest $request): OffsetResponse
    {
        $result = ProductModel::orderBy('id')
            ->paginate(perPage: $request->size, page: $request->page);
        return new OffsetResponse(
            totalCount: $result->total(),
            page: $request->page,
            size: $request->size,
            hasNextPage: $result->hasMorePages(),
            items: collect($result->items())
                ->map(fn($item) => $this->toResponse($item))
                ->toArray()
        );
    }

    function listByCursor(CursorRequest $request): CursorResponse
    {
        $id = $request->cursor
            ? ProductModel::where('public_id', $request->cursor)->value('id')
            : null;
        $laravelCursor = $id
            ? new Cursor(['id' => $id])
            : null;
        return PaginationService::buildCursorQuery(
            query: ProductModel::orderBy('id'),
            cursor: $laravelCursor,
            size: $request->size,
            mapper: fn($item) => $this->toResponse($item)
        );
    }
}
