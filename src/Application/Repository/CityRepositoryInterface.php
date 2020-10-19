<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Model\Cities;
use App\Domain\Model\City;

interface CityRepositoryInterface
{
    public function getAllCities(): Cities;

    public function getByName(string $cityName): City;

    public function store(Cities $cities): void;
}
