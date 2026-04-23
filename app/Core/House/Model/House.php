<?php

namespace App\Core\House\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;
use InvalidArgumentException;

final class House
{
    private const int MAX_PLACES = 10;

    private function __construct(
        protected string $id,
        protected string $ownerId,
        protected string $name,
        /** @var Place[] */
        protected array  $places,
        protected Carbon $createdAt
    )
    {
    }

    public static function load(string $id, string $ownerId, string $name, array $places, Carbon $createdAt): House
    {
        return new self($id, $ownerId, $name, $places, $createdAt);
    }

    public static function create(string $ownerId, string $name): House
    {
        return new self(
            Utils::generateUUIDV4(),
            $ownerId,
            $name,
            [],
            Carbon::now()
        );
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return Place[]
     */
    public function getPlaces(): array
    {
        return [...$this->places];
    }

    public function addPlace(Place $place): void
    {
        if (count($this->places) >= self::MAX_PLACES) {
            throw new InvalidArgumentException("Cannot add more than " . self::MAX_PLACES . " places to the house.");
        }
        if ($this->existsPlace($place->getId())) {
            throw new InvalidArgumentException("Place with name '{$place->getId()}' already exists in the house.");
        }
        $this->places[] = $place;
    }

    public function existsPlace(string $placeId): bool
    {
        foreach ($this->places as $place) {
            if ($place->getId() === $placeId) {
                return true;
            }
        }
        return false;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function removePlace(string $placeId): void
    {
        if (!$this->existsPlace($placeId)) {
            throw new InvalidArgumentException("Place '$placeId' does not exists.");
        }
        $this->places = array_filter($this->places, function (Place $place) use ($placeId) {
            return $place->getId() !== $placeId;
        });
    }

    public function findPlace(string $placeId): ?Place
    {
        foreach ($this->places as $place) {
            if ($place->getId() === $placeId) {
                return $place;
            }
        }
        return null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function changeName(?string $newName): void
    {
        if ($newName === null) {
            return;
        }
        $this->name = $newName;
    }
}

