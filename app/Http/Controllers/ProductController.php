<?php

namespace App\Http\Controllers;

use App\Core\Product\Application\Dto\Request\AddMedicalProductRequest;
use App\Core\Product\Application\Dto\Response\MedicalProductResponse;
use App\Core\Product\Application\Port\MedicalProductReadRepository;
use App\Core\Product\Application\Service\AddMedicalProduct;
use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\OffsetRequest;
use App\Services\PaginationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected MedicalProductReadRepository $medicalProductReadRepository,
        protected AddMedicalProduct            $addMedicalProduct,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return PaginationService::paginate(
            $request,
            fn(CursorRequest $cursorRequest) => $this->medicalProductReadRepository->listByCursor($cursorRequest),
            fn(OffsetRequest $offsetRequest) => $this->medicalProductReadRepository->listByOffset($offsetRequest),
            fn(MedicalProductResponse $response) => $this->buildView($response)
        );
    }

    private function buildView(MedicalProductResponse $response): array
    {
        return [
            'id' => $response->id,
            'name' => $response->name,
            'description' => $response->description,
            'presentationType' => $response->presentationType,
            'concentration' => [
                'value' => $response->concentrationValue,
                'unit' => $response->concentrationUnit,
            ],
            'addedDate' => $response->addedDate,
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'presentationType' => 'required|max:255',
            'concentrationValue' => 'required|numeric',
            'concentrationUnit' => 'required|max:255',
        ]);
        $data = new AddMedicalProductRequest(
            $validatedData['name'],
            $validatedData['description'],
            $validatedData['presentationType'],
            $validatedData['concentrationUnit'],
            $validatedData['concentrationValue'],
        );
        $result = $this->addMedicalProduct->execute($data);
        return response()->json($this->buildView($result), 201);
    }

    public function show(string $productId): JsonResponse
    {
        $product = $this->medicalProductReadRepository->findById($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($this->buildView($product));
    }
}
