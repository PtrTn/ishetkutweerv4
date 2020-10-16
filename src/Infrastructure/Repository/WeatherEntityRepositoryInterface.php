<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\WeatherEntity;

interface WeatherEntityRepositoryInterface
{
    /**
     * @param WeatherEntity[] $entities
     */
    public function saveEntities(array $entities): void;

    /**
     * @param WeatherEntity[] $entities
     */
    public function deleteEntities(array $entities): void;

    /**
     * @return WeatherEntity[]
     */
    public function getLatestEntites(): array;

    /**
     * @return WeatherEntity[]
     */
    public function getOutdatedEntities(): array;

    public function findLatestEntityForLocation(string $location): ?WeatherEntity;
}
