<?php

namespace App\Http\Controllers;

use App\Core\Item\Application\Dto\Request\AddMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\MedicalItemResponse;
use App\Core\Item\Application\Dto\Response\MedicalItemViewResponse;
use App\Core\Item\Application\Port\AddMedicalItem;
use App\Core\Item\Application\Port\DeleteMedicalItem;
use App\Core\Item\Application\Port\MedicalItemReadRepository;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\OffsetRequest;
use App\Services\PaginationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(
        protected AddMedicalItem            $addMedicalItem,
        protected MedicalItemReadRepository $medicalItemReadRepository,
        protected DeleteMedicalItem         $deleteMedicalItem
    )
    {
    }

    public function index(Request $request, string $placeId): JsonResponse
    {
        return PaginationService::paginate(
            $request,
            fn(CursorRequest $cursorRequest) => $this->medicalItemReadRepository->listByPlaceIdByCursor($placeId, $cursorRequest),
            fn(OffsetRequest $offsetRequest) => $this->medicalItemReadRepository->listByPlaceIdByOffset($placeId, $offsetRequest),
            fn(MedicalItemViewResponse $response) => $this->buildView($response)
        );
    }

    private function buildView(MedicalItemViewResponse $response): array
    {
        return [
            'id' => $response->id,
            'product' => [
                'id' => $response->medicalProduct->id,
                'name' => $response->medicalProduct->name,
                'description' => $response->medicalProduct->description,
                'presentationType' => $response->medicalProduct->presentationType,
                'concentration' => [
                    'value' => $response->medicalProduct->concentrationValue,
                    'unit' => $response->medicalProduct->concentrationUnit,
                ]
            ],
            'place' => [
                'id' => $response->storageUnit->placeId,
                'name' => $response->storageUnit->name,
            ],
            'totalQuantity' => $response->totalQuantity,
            'availableQuantity' => $response->availableQuantity,
            'expirationDate' => $response->expirationDate->toDateString(),
            'addedDate' => $response->addedDate->toDateString(),
        ];
    }

    public function store(Request $request, string $placeId): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'product_id' => 'required|uuid',
            'expiration_date' => 'required|date',
        ]);
        $data = new AddMedicalItemRequest(
            $placeId,
            $validatedData['name'],
            $validatedData['product_id'],
            $validatedData['expiration_date']
        );
        $result = $this->addMedicalItem->execute($data);
        return $this->buildResponse($result);
    }

    private function buildResponse(MedicalItemViewResponse|MedicalItemResponse $result): JsonResponse
    {
        if ($result instanceof MedicalItemViewResponse) {
            return response()->json($this->buildView($result));
        } else {
            return response()->json([
                'id' => $result->id,
                'productId' => $result->medicalProductId,
                'placeId' => $result->placeId,
                'totalQuantity' => $result->totalQuantity,
                'availableQuantity' => $result->availableQuantity,
                'expirationDate' => $result->expirationDate->toDateString(),
                'addedDate' => $result->addedDate->toDateString(),
            ], 201);
        }
    }

    public function show(string $itemId): JsonResponse
    {
        $item = $this->medicalItemReadRepository->findById($itemId);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        return $this->buildResponse($item);
    }

    public function destroy(string $itemId): JsonResponse
    {
        $this->deleteMedicalItem->execute($itemId);
        return response()->json(null, 204);
    }
}
