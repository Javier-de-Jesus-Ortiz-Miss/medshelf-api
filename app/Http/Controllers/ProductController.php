<?php

namespace App\Http\Controllers;

use App\core\inventory\app\dto\request\AddProductRequest;
use App\core\inventory\app\port\AddProduct;
use App\core\inventory\app\port\ProductOnlyRead;
use App\core\shared\domain\PaginationRequest;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function __construct(
        protected AddProduct      $addProduct,
        protected ProductOnlyRead $productOnlyRead
    )
    {
    }

    /**
     * Add a new product to the inventory.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'brandName' => 'required|string',
                'shape' => 'required|string',
                'totalAmount' => 'required|integer|min:1',
                'unit' => 'required|string',
                'substances' => 'required|array|min:1',
                'expirationDate' => 'required|date_format:Y-m-d',
            ]);

            $addProductRequest = new AddProductRequest(
                brandName: $validated['brandName'],
                shape: $validated['shape'],
                totalAmount: $validated['totalAmount'],
                unit: $validated['unit'],
                substances: $validated['substances'],
                expirationDate: new DateTime($validated['expirationDate'])
            );
            $product = $this->addProduct->execute($addProductRequest);

            return response()->json([
                $product
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function list(Request $request): JsonResponse
    {
        try {
            $page = $request->query('page', 1);
            $size = $request->query('size', 10);
            $pageRequest = new PaginationRequest(
                page: $page,
                size: $size,
            );
            $pageResult = $this->productOnlyRead->listAll($pageRequest);
            return response()->json([$pageResult]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

