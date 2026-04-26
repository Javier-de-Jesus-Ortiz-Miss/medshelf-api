<?php

namespace App\Http\Controllers;

use App\Core\Item\Application\Dto\Request\ConsumeMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\ConsumptionResponse;
use App\Core\Item\Application\Dto\Response\ConsumptionViewResponse;
use App\Core\Item\Application\Port\ConsumptionReadRepository;
use App\Core\Item\Application\UseCase\ConsumeMedicalItem;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\OffsetRequest;
use App\Services\PaginationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    private function __construct(
        protected ConsumptionReadRepository $consumptionReadRepository,
        protected ConsumeMedicalItem        $consumeMedicalItem
    )
    {
    }

    public function index(Request $request, string $itemId): JsonResponse
    {
        return PaginationService::paginate(
            $request,
            fn(CursorRequest $cursorRequest) => $this->consumptionReadRepository->listByItemIdByCursor($itemId, $cursorRequest),
            fn(OffsetRequest $offsetRequest) => $this->consumptionReadRepository->listByItemIdByOffset($itemId, $offsetRequest),
            fn(ConsumptionViewResponse $response) => $this->buildView($response)
        );
    }

    private function buildView(ConsumptionViewResponse $response): array
    {
        return [
            'id' => $response->id,
            'item' => [
                'id' => $response->medicalItem->id,
                'productId' => $response->medicalItem->medicalProductId,
                'placeId' => $response->medicalItem->storageUnitId,
                'totalQuantity' => $response->medicalItem->totalQuantity,
                'availableQuantity' => $response->medicalItem->availableQuantity,
                'expirationDate' => $response->medicalItem->expirationDate,
                'addedDate' => $response->medicalItem->addedDate,
            ],
            'amount' => $response->amount,
            'consumptionDate' => $response->consumptionDate,
        ];
    }

    public function store(string $itemId): JsonResponse
    {
        $validatedData = request()->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $data = new ConsumeMedicalItemRequest(
            $itemId,
            $validatedData['amount'],
        );
        $result = $this->consumeMedicalItem->execute($data);
        return $this->buildResponse($result);
    }

    private function buildResponse(ConsumptionViewResponse|ConsumptionResponse $result): JsonResponse
    {
        if ($result instanceof ConsumptionViewResponse) {
            return response()->json($this->buildView($result));
        } else {
            return response()->json([
                'id' => $result->id,
                'itemId' => $result->medicalItemId,
                'amount' => $result->amount,
                'consumptionDate' => $result->consumptionDate,
            ], 201);
        }
    }

    public function show(string $consumptionId): JsonResponse
    {
        $consumption = $this->consumptionReadRepository->findById($consumptionId);
        return $this->buildResponse($consumption);
    }
}
