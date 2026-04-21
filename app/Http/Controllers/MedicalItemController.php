<?php

namespace App\Http\Controllers;

use App\Core\Item\Application\Dto\Request\AddMedicalItemRequest;
use App\Core\Item\Application\Dto\Request\ConsumeMedicalItemRequest;
use App\Core\Item\Application\Port\AddMedicalItem;
use App\Core\Item\Application\Port\ConsumeMedicalItem;
use App\Core\Item\Application\Port\DeleteMedicalItem;
use App\Core\Item\Application\Port\MedicalItemReadRepository;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\OffsetRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicalItemController extends Controller
{
    public function __construct(
        protected MedicalItemReadRepository $medicalItemReadRepository,
        protected AddMedicalItem            $addMedicalItem,
        protected ConsumeMedicalItem        $consumeMedicalItem,
        protected DeleteMedicalItem         $deleteMedicalItem
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
            $response = $this->medicalItemReadRepository->listByCursor($cursorRequest);

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
        $response = $this->medicalItemReadRepository->listByOffset($offsetRequest);

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
        return array_map(fn($item) => $this->formatItem($item), $items);
    }

    private function formatItem($item): array
    {
        return [
            'id' => $item->id,
            'medicalProduct' => [
                'id' => $item->medicalProduct->id,
                'name' => $item->medicalProduct->name,
                'description' => $item->medicalProduct->description,
                'presentationType' => $item->medicalProduct->presentationType,
                'concentration' => [
                    'value' => $item->medicalProduct->concentrationValue,
                    'unit' => $item->medicalProduct->concentrationUnit,
                ],
            ],
            'storageUnit' => [
                'id' => $item->storageUnit->id,
                'houseId' => $item->storageUnit->houseId,
                'name' => $item->storageUnit->name,
            ],
            'totalQuantity' => $item->totalQuantity,
            'availableQuantity' => $item->availableQuantity,
            'expirationDate' => $item->expirationDate->toIso8601String(),
            'addedDate' => $item->addedDate->toIso8601String(),
        ];
    }

    public function show(string $itemId): JsonResponse
    {
        $item = $this->medicalItemReadRepository->findById($itemId);

        if (!$item) {
            return response()->json(['error' => 'Medical item not found'], 404);
        }

        return response()->json($this->formatItem($item), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'medicalProductId' => 'required|string',
            'storageUnitId' => 'required|string',
            'totalQuantity' => 'required|integer|min:1',
            'expirationDate' => 'required|date',
        ]);

        $addRequest = new AddMedicalItemRequest(
            $validated['medicalProductId'],
            $validated['storageUnitId'],
            (string)$validated['totalQuantity'],
            Carbon::parse($validated['expirationDate'])
        );

        $response = $this->addMedicalItem->execute($addRequest);

        return response()->json([
            'id' => $response->id,
            'medicalProductId' => $response->medicalProductId,
            'storageUnitId' => $response->storageUnitId,
            'totalQuantity' => $response->totalQuantity,
            'availableQuantity' => $response->availableQuantity,
            'expirationDate' => $response->expirationDate->toIso8601String(),
            'addedDate' => $response->addedDate->toIso8601String(),
        ], 201);
    }

    public function destroy(string $itemId): JsonResponse
    {
        $this->deleteMedicalItem->execute($itemId);
        return response()->json(null, 204);
    }

    public function consume(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'medicalItemId' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $consumeRequest = new ConsumeMedicalItemRequest(
            $validated['medicalItemId'],
            $validated['quantity']
        );

        $response = $this->consumeMedicalItem->execute($consumeRequest);

        return response()->json([
            'id' => $response->id,
            'medicalProductId' => $response->medicalProductId,
            'storageUnitId' => $response->storageUnitId,
            'totalQuantity' => $response->totalQuantity,
            'availableQuantity' => $response->availableQuantity,
            'expirationDate' => $response->expirationDate->toIso8601String(),
            'addedDate' => $response->addedDate->toIso8601String(),
        ], 200);
    }
}

