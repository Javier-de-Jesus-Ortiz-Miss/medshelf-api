<?php

namespace App\Http\Controllers;

use App\Core\House\Application\Dto\Request\AddPlaceRequest;
use App\Core\House\Application\Dto\Request\RemovePlaceRequest;
use App\Core\House\Application\Dto\Request\RemovePlacesRequest;
use App\Core\House\Application\Dto\Request\UpdatePlaceRequest;
use App\Core\House\Application\Dto\Response\PlaceResponse;
use App\Core\House\Application\Dto\Response\PlaceViewResponse;
use App\Core\House\Application\Port\AddPlace;
use App\Core\House\Application\Port\PlaceReadRepository;
use App\Core\House\Application\Port\RemovePlace;
use App\Core\House\Application\Port\RemovePlaces;
use App\Core\House\Application\Port\UpdatePlace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    private function __construct(
        protected PlaceReadRepository $placeReadRepository,
        protected AddPlace            $addPlace,
        protected UpdatePlace         $updatePlace,
        protected RemovePlaces        $removePlaces,
        protected RemovePlace         $removePlace
    )
    {
    }

    public function index(string $houseId): JsonResponse
    {
        $places = $this->placeReadRepository->list($houseId);
        return response()->json([
            'places' => array_map(fn(PlaceResponse $place) => [
                'id' => $place->id,
                'name' => $place->name,
            ], $places)
        ]);
    }

    public function store(Request $request, string $houseId): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $data = new AddPlaceRequest(
            $houseId,
            $validatedData['name']
        );
        $result = $this->addPlace->execute($data);
        return $this->buildResponse($result);
    }

    private function buildResponse(PlaceViewResponse|PlaceResponse $result): JsonResponse
    {
        if ($result instanceof PlaceViewResponse) {
            return response()->json([
                'id' => $result->id,
                'house' => [
                    'id' => $result->house->id,
                    'name' => $result->house->name,
                ],
                'name' => $result->name,
            ]);
        } else {
            return response()->json([
                'id' => $result->id,
                'houseId' => $result->houseId,
                'name' => $result->name,
            ]);
        }
    }

    public function show(string $placeId): JsonResponse
    {
        $place = $this->placeReadRepository->findById($placeId);
        return $this->buildResponse($place);
    }

    public function update(Request $request, string $placeId): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $data = new UpdatePlaceRequest(
            $placeId,
            $validatedData['name']
        );
        $result = $this->updatePlace->execute($data);
        return $this->buildResponse($result);
    }

    public function destroy(string $placeId): JsonResponse
    {
        $request = new RemovePlaceRequest(
            $placeId,
        );
        $this->removePlace->execute($request);
        return response()->json(null, 204);
    }

    public function bulkDelete(Request $request, string $houseId): JsonResponse
    {
        $validatedData = $request->validate([
            'placeIds' => 'required|array',
            'placeIds.*' => 'uuid',
        ]);
        $data = new RemovePlacesRequest(
            $houseId,
            $validatedData['placeIds']
        );
        $this->removePlaces->execute($data);
        return response()->json(null, 204);
    }
}
