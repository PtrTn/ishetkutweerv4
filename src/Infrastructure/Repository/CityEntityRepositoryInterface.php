<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\CityEntity;

interface CityEntityRepositoryInterface
{
    /**
     * @param CityEntity[] $entities
     */
    public function saveEntities(array $entities): void;

    /** @return CityEntity[] */
    public function getAllEntities(): array;
}
