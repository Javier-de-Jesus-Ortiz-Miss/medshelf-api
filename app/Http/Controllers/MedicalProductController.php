<?php

namespace App\Http\Controllers;

use App\Core\Product\Application\Dto\Request\AddMedicalProductRequest;
use App\Core\Product\Application\Port\AddMedicalProduct;
use App\Core\Product\Application\Port\MedicalProductReadRepository;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\OffsetRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicalProductController extends Controller
{
    public function __construct(
        protected MedicalProductReadRepository $medicalProductReadRepository,
        protected AddMedicalProduct            $addMedicalProduct
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
            $response = $this->medicalProductReadRepository->listByCursor($cursorRequest);

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
        $response = $this->medicalProductReadRepository->listByOffset($offsetRequest);

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
        return array_map(fn($item) => $this->formatProduct($item), $items);
    }

    private function formatProduct($product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'presentationType' => $product->presentationType,
            'concentration' => [
                'value' => $product->concentrationValue,
                'unit' => $product->concentrationUnit,
            ],
            'createdAt' => $product->addedDate->toIso8601String(),
        ];
    }

    public function show(string $productId): JsonResponse
    {
        $product = $this->medicalProductReadRepository->findById($productId);

        if (!$product) {
            return response()->json(['error' => 'Medical product not found'], 404);
        }

        return response()->json($this->formatProduct($product), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'presentationType' => 'required|string',
            'concentrationValue' => 'required|numeric',
            'concentrationUnit' => 'required|string',
        ]);

        $addRequest = new AddMedicalProductRequest(
            $validated['name'],
            $validated['description'],
            $validated['presentationType'],
            $validated['concentrationUnit'],
            (int)$validated['concentrationValue']
        );

        $response = $this->addMedicalProduct->execute($addRequest);

        return response()->json([
            'id' => $response->id,
            'name' => $response->name,
            'description' => $response->description,
            'presentationType' => $response->presentationType,
            'concentrationValue' => $response->concentrationValue,
            'concentrationUnit' => $response->concentrationUnit,
            'createdAt' => $response->addedDate->toIso8601String(),
        ], 201);
    }
}


