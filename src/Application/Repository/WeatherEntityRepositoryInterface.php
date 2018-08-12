<?php

namespace App\Application\Repository;

interface WeatherEntityRepositoryInterface
{
    public function saveEntities(array $entities): void;

    public function deleteEntities(array $entities): void;

    public function getLatestEntites(): array;

    public function getOutdatedEntities(): array;
}
