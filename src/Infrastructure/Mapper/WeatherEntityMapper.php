<?php

namespace App\Infrastructure\Mapper;

use App\Application\Mapper\WeatherEntityMapperInterface;
use App\Domain\Dto\LocationDto;
use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingDto;
use App\Infrastructure\Entity\WeatherEntity;

class WeatherEntityMapper implements WeatherEntityMapperInterface
{
    public function createEntityFromDto(WeatherDto $dto): WeatherEntity
    {
        $entity = new WeatherEntity();
        $entity->region = $dto->location->region;
        $entity->stationName = $dto->location->stationName;
        $entity->lat = $dto->location->lat;
        $entity->lon = $dto->location->lon;
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

    public function createDtoFromEntity(WeatherEntity $entity): WeatherDto
    {
        $dto = new WeatherDto();
        $dto->date = $entity->date;
        $dto->temperature = $entity->temperature;
        $dto->windSpeed = $entity->windSpeed;
        $dto->windDirection = $entity->windDirection;
        $dto->rain = $entity->rain;
        $dto->background = $entity->background;

        $locationDto = new LocationDto();
        $locationDto->stationName = $entity->stationName;
        $locationDto->region = $entity->region;
        $locationDto->lat = $entity->lat;
        $locationDto->lon = $entity->lon;
        $dto->location = $locationDto;

        $ratingDto = new WeatherRatingDto();
        $ratingDto->temperatureRating = $entity->temperatureRating;
        $ratingDto->rainRating = $entity->rainRating;
        $ratingDto->windRating = $entity->windRating;
        $dto->rating = $ratingDto;

        return $dto;
    }
}
