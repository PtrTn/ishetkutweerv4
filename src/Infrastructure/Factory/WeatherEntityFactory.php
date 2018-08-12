<?php

namespace App\Infrastructure\Factory;

use App\Application\Factory\WeatherEntityFactoryInterface;
use App\Domain\Dto\WeatherDto;
use App\Infrastructure\Entity\WeatherEntity;

class WeatherEntityFactory implements WeatherEntityFactoryInterface
{
    public function createFromWeatherDto(WeatherDto $dto): WeatherEntity
    {
        $entity = new WeatherEntity();
        $entity->location = $dto->location;
        $entity->date = $dto->date;
        $entity->temperature = $dto->temperature;
        $entity->windSpeed = $dto->windSpeed;
        $entity->windDirection = $dto->windDirection;
        $entity->rain = $dto->rain;
        $entity->temperatureRating = $dto->rating->temperatureRating->getRating();
        $entity->rainRating = $dto->rating->rainRating->getRating();
        $entity->windRating = $dto->rating->windRating->getRating();
        $entity->background = $dto->background;
        return $entity;
    }
}
