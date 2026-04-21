<?php

namespace App\Core\House\Model;

use App\Core\Shared\Domain\Place;
use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;
use InvalidArgumentException;

final class House
{
    private function __construct(
        private string $id,
        private string $ownerId,
        private string $name,
        /** @var Place[] */
        private array  $places,
        private Carbon $createdAt
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

    public function getName(): string
    {
        return $this->name;
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
        if ($this->existsPlace($place->name)) {
            throw new InvalidArgumentException("Place with name '$place->name' already exists in the house.");
        }
        $this->places[] = $place;
    }

    public function existsPlace(string $name): bool
    {
        foreach ($this->places as $place) {
            if ($place->name === $name) {
                return true;
            }
        }
        return false;
    }

    public function removePlace(string $name): void
    {
        if (!in_array($name, $this->places)) {
            throw new InvalidArgumentException("Place with name '$name' does not exist in the house.");
        }
        $this->places = array_filter($this->places, fn(Place $p) => $p->name !== $name);
    }

    public function findPlace(string $name): ?Place
    {
        foreach ($this->places as $place) {
            if ($place->name === $name) {
                return $place;
            }
        }
        return null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function changeName(?string $newName): void
    {
        if ($newName === null) {
            return;
        }
        $this->name = $newName;
    }
}

