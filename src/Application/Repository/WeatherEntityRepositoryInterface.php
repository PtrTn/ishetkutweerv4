<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Application\Entity\WeatherEntityInterface;

interface WeatherEntityRepositoryInterface
{
    /**
     * @param WeatherEntityInterface[] $entities
     */
    public function saveEntities(array $entities): void;

    /**
     * @param WeatherEntityInterface[] $entities
     */
    public function deleteEntities(array $entities): void;

    /**
     * @return WeatherEntityInterface[]
     */
    public function getLatestEntites(): array;

    /**
     * @return WeatherEntityInterface[]
     */
    public function getOutdatedEntities(): array;
}
