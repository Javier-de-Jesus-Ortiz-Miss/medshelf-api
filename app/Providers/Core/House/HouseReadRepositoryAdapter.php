<?php

namespace App\Providers\Core\House;

use App\Core\House\Application\Dto\Data\OwnerResume;
use App\Core\House\Application\Dto\Response\HouseViewResponse;
use App\Core\House\Application\Port\HouseReadRepository;
use App\Models\HouseModel;

class HouseReadRepositoryAdapter implements HouseReadRepository
{

    public function findById(string $id): ?HouseViewResponse
    {
        $record = HouseModel::with(['owner' => fn($q) => $q->select('id', 'public_id', 'name')])
            ->where('public_id', $id)
            ->first();
        if (!$record) return null;
        return $this->toView($record);
    }

    private function toView(HouseModel $record): HouseViewResponse
    {
        $owner = $record->owner;
        return new HouseViewResponse(
            id: $record->public_id,
            owner: new OwnerResume(
                $owner->public_id,
                $owner->name,
                $owner->name
            ),
            name: $record->name,
            createdAt: $record->created_at
        );
    }
}
