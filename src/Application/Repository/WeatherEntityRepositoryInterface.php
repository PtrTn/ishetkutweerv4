<?php

namespace App\Application\Repository;

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
}
