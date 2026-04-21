<?php

namespace App\Http\Controllers;

use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Storage\Application\Port\StorageUnitReadRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StorageUnitController extends Controller
{
    public function __construct(
        protected StorageUnitReadRepository $storageUnitReadRepository
    )
    {
    }

    public function list(Request $request): JsonResponse
    {
        // Check if both offset and cursor are provided
        if ($request->has('offset') && $request->has('cursor')) {
            return response()->json(['error' => 'Only one pagination method can be used'], 400);
        }

        // Cursor-based pagination
        if ($request->has('cursor')) {
            $cursorRequest = new CursorRequest(
                $request->query('cursor'),
                $request->query('limit', 10)
            );
            $response = $this->storageUnitReadRepository->listByCursor($cursorRequest);

            return response()->json([
                'items' => $this->formatItems($response->items),
                'nextCursor' => $response->nextCursor,
            ], 200);
        }

        // Offset-based pagination (default)
        $offsetRequest = new OffsetRequest(
            $request->query('offset', 0),
            $request->query('limit', 10)
        );
        $response = $this->storageUnitReadRepository->listByOffset($offsetRequest);

        return response()->json([
            'items' => $this->formatItems($response->items),
            'totalCount' => $response->totalCount,
            'offset' => $response->offset,
            'limit' => $response->limit,
            'hasNextPage' => $response->hasNextPage,
        ], 200);
    }

    private function formatItems(array $items): array
    {
        return array_map(fn($item) => $this->formatStorageUnit($item), $items);
    }

    private function formatStorageUnit($storageUnit): array
    {
        return [
            'id' => $storageUnit->id,
            'houseId' => $storageUnit->houseId,
            'name' => $storageUnit->name,
            'createdAt' => $storageUnit->createdAt->toIso8601String(),
        ];
    }

    public function show(string $storageId): JsonResponse
    {
        $storageUnit = $this->storageUnitReadRepository->findById($storageId);

        if (!$storageUnit) {
            return response()->json(['error' => 'Storage unit not found'], 404);
        }

        return response()->json($this->formatStorageUnit($storageUnit), 200);
    }
}

