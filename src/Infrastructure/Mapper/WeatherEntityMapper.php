<?php

namespace App\Infrastructure\Mapper;

use App\Application\Mapper\WeatherEntityMapperInterface;
use App\Domain\Dto\ForecastDayDto;
use App\Domain\Dto\ForecastDto;
use App\Domain\Dto\LocationDto;
use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingDto;
use App\Domain\ValueObject\Rating;
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
        $entity->summary = $dto->summary;
        $entity->day1Day = $dto->forecast->day1->day;
        $entity->day1Temp = $dto->forecast->day1->temperature;
        $entity->day2Day = $dto->forecast->day2->day;
        $entity->day2Temp = $dto->forecast->day2->temperature;
        $entity->day3Day = $dto->forecast->day3->day;
        $entity->day3Temp = $dto->forecast->day3->temperature;
        $entity->day4Day = $dto->forecast->day4->day;
        $entity->day4Temp = $dto->forecast->day4->temperature;
        $entity->day5Day = $dto->forecast->day5->day;
        $entity->day5Temp = $dto->forecast->day5->temperature;
        return $entity;
    }

    public function createDtoFromEntity(WeatherEntity $entity): WeatherDto
    {
        $locationDto = new LocationDto();
        $locationDto->stationName = $entity->stationName;
        $locationDto->region = $entity->region;
        $locationDto->lat = $entity->lat;
        $locationDto->lon = $entity->lon;

        $ratingDto = new WeatherRatingDto();
        $ratingDto->temperatureRating = new Rating($entity->temperatureRating);
        $ratingDto->rainRating = new Rating($entity->rainRating);
        $ratingDto->windRating = new Rating($entity->windRating);
        
        $day1 = new ForecastDayDto();
        $day1->day = $entity->day1Day;
        $day1->temperature = $entity->day1Temp;
        
        $day2 = new ForecastDayDto();
        $day2->day = $entity->day2Day;
        $day2->temperature = $entity->day2Temp;
        
        $day3 = new ForecastDayDto();
        $day3->day = $entity->day3Day;
        $day3->temperature = $entity->day3Temp;
        
        $day4 = new ForecastDayDto();
        $day4->day = $entity->day4Day;
        $day4->temperature = $entity->day4Temp;
        
        $day5 = new ForecastDayDto();
        $day5->day = $entity->day5Day;
        $day5->temperature = $entity->day5Temp;
        
        $forecastDto = new ForecastDto();
        $forecastDto->day1 = $day1;
        $forecastDto->day2 = $day2;
        $forecastDto->day3 = $day3;
        $forecastDto->day4 = $day4;
        $forecastDto->day5 = $day5;

        $dto = new WeatherDto();
        $dto->date = $entity->date;
        $dto->temperature = $entity->temperature;
        $dto->windSpeed = $entity->windSpeed;
        $dto->windDirection = $entity->windDirection;
        $dto->rain = $entity->rain;
        $dto->background = $entity->background;
        $dto->summary = $entity->summary;
        $dto->location = $locationDto;
        $dto->rating = $ratingDto;
        $dto->forecast = $forecastDto;

        return $dto;
    }
}
