<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\CityEntity;
use Generator;

interface CityEntityRepositoryInterface
{
    /** @return CityEntity[] */
    public function getAllCities(): array;

    public function getByName(string $cityName): CityEntity;

    public function saveEntities(Generator $entities): void;
}
