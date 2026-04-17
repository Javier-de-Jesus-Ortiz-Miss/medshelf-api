<?php

namespace App\Http\Controllers;

use App\Core\Storage\Application\Dto\Request\CreateStorageUnitRequest;
use App\Core\Storage\Application\Dto\Request\ModifyStorageUnitRequest;
use App\Core\Storage\Application\Port\CreateStorageUnit;
use App\Core\Storage\Application\Port\ModifyStorageUnit;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StorageController extends Controller
{
    public function __construct(
        protected CreateStorageUnit $createStorageUnit,
        protected ModifyStorageUnit $modifyStorageUnit
    )
    {
    }

    /**
     * POST /storage
     * @param Request $request
     * @return JsonResponse
     */
    public function createStorageUnit(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'houseId' => 'required|string|max:255',
                'name' => 'required|string|max:255'
            ]);
            $request = new CreateStorageUnitRequest(
                $validatedData['houseId'],
                $validatedData['name']
            );
            $result = $this->createStorageUnit->execute($request);
            return response()->json($result, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception) {
            return response()->json(['error' => 'An unexpected error has occurred'], 500);
        }
    }

    /**
     * PUT /storage/{id}
     * @param Request $request
     * @param string $houseId
     * @return JsonResponse
     */
    public function updateStorageUnit(Request $request, string $houseId): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'string|max:255'
            ]);
            $request = new ModifyStorageUnitRequest(
                $houseId,
                $validatedData['name']
            );
            $result = $this->modifyStorageUnit->execute($request);
            return response()->json($result, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception) {
            return response()->json(['error' => 'An unexpected error has occurred'], 500);
        }
    }
}
