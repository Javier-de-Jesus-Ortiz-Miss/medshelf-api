<?php

namespace App\Http\Controllers;

use App\Core\House\Application\Dto\Request\ModifyPlacesRequest;
use App\Core\House\Application\Port\AddPlaces;
use App\Core\House\Application\Port\HouseReadRepository;
use App\Core\House\Application\Port\RemovePlaces;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function __construct(
        protected HouseReadRepository $houseReadRepository,
        protected AddPlaces           $addPlaces,
        protected RemovePlaces        $removePlaces
    )
    {
    }

    public function show(string $houseId): JsonResponse
    {
        $house = $this->houseReadRepository->findById($houseId);

        if (!$house) {
            return response()->json(['error' => 'House not found'], 404);
        }

        return response()->json([
            'id' => $house->id,
            'ownerId' => $house->ownerId,
            'name' => $house->name,
            'places' => array_map(fn($place) => $place->name, $house->places),
            'createdAt' => $house->createdAt->toIso8601String(),
        ], 200);
    }

    public function modifyPlaces(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'houseId' => 'required|string',
            'addedPlaces' => 'nullable|array',
            'removedPlaces' => 'nullable|array',
        ]);

        $ownerId = auth()->id();
        $placesToAdd = $validated['addedPlaces'] ?? [];
        $placesToRemove = $validated['removedPlaces'] ?? [];

        // First add places
        if (!empty($placesToAdd)) {
            $addRequest = new ModifyPlacesRequest($ownerId, $placesToAdd);
            $this->addPlaces->execute($addRequest);
        }

        // Then remove places
        if (!empty($placesToRemove)) {
            $removeRequest = new ModifyPlacesRequest($ownerId, $placesToRemove);
            $this->removePlaces->execute($removeRequest);
        }

        // Return updated house
        $house = $this->houseReadRepository->findById($validated['houseId']);

        return response()->json([
            'id' => $house->id,
            'houseId' => $house->id,
            'name' => $house->name,
            'createdAt' => $house->createdAt->toIso8601String(),
        ], 201);
    }
}

