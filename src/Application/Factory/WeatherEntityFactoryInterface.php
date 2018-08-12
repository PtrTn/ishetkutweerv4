<?php

namespace App\Application\Factory;

use App\Domain\Dto\WeatherDto;
use App\Infrastructure\Entity\WeatherEntity;

interface WeatherEntityFactoryInterface
{
    public function createFromWeatherDto(WeatherDto $dto): WeatherEntity;
}
