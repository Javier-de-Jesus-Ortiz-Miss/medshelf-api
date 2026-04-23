<?php

namespace App\Http\Controllers;

use App\Core\House\Application\Dto\Response\HouseViewResponse;
use App\Core\House\Application\Port\HouseReadRepository;
use Illuminate\Http\JsonResponse;

class HouseController extends Controller
{
    public function __construct(
        protected HouseReadRepository $houseReadRepository
    )
    {
    }

    public function show(string $houseId): JsonResponse
    {
        $house = $this->houseReadRepository->findById($houseId);
        if (!$house) {
            return response()->json(['message' => 'House not found'], 404);
        }
        return response()->json($this->buildView($house));
    }

    private function buildView(HouseViewResponse $response): array
    {
        return [
            'id' => $response->id,
            'owner' => [
                'id' => $response->owner->id,
                'firstName' => $response->owner->firstName,
                'lastName' => $response->owner->lastName,
            ],
            'name' => $response->name,
            'createdAt' => $response->createdAt->toDateTimeString(),
        ];
    }
}
