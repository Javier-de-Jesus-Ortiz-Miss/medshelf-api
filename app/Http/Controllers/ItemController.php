<?php

namespace App\Http\Controllers;

use App\Core\Item\Application\Dto\Request\AddItemRequest;
use App\Core\Item\Application\Dto\Request\ConsumeItemRequest;
use App\Core\Item\Application\Port\AddItem;
use App\Core\Item\Application\Port\ConsumeItem;
use App\Core\Item\Application\Port\DeleteItem;
use App\Core\Item\Application\Port\ItemReadRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    public function __construct(
        protected AddItem            $addItem,
        protected ConsumeItem        $consumeItem,
        protected DeleteItem         $deleteItem,
        protected ItemReadRepository $itemReadRepository
    )
    {
    }

    /**
     * POST /item
     * @param Request $request
     * @return JsonResponse
     */
    public function addItem(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'productId' => 'required|string|max:255',
                'storageUnitId' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'expirationDate' => 'required|date',
            ]);
            $request = new AddItemRequest(
                productId: $validatedData['productId'],
                storageUnitId: $validatedData['storageUnitId'],
                quantity: $validatedData['quantity'],
                expirationDate: $validatedData['expirationDate']
            );
            $result = $this->addItem->execute($request);
            return response()->json($result, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception) {
            return response()->json(['error' => 'An unexpected error has occurred'], 500);
        }
    }

    /**
     * POST /item/{id}/consume
     * @param Request $request
     * @param string $itemId
     * @return JsonResponse
     */
    public function consumeItem(Request $request, string $itemId): JsonResponse
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        try {
            $request = new ConsumeItemRequest(
                itemId: $itemId,
                quantity: $validatedData['quantity']
            );
            $this->consumeItem->execute($request);
            return response()->json(null, 204);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception) {
            return response()->json(['error' => 'An unexpected error has occurred'], 500);
        }
    }
}
