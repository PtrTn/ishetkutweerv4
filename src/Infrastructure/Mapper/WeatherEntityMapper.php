<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Application\Entity\WeatherEntityInterface;
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
        $entity->averageRating = $dto->rating->averageRating->getRating();
        $entity->background = $dto->background;
        $entity->summary = $dto->summary;
        $entity->day1Date = $dto->forecast->day1->date;
        $entity->day1Temp = $dto->forecast->day1->temperature;
        $entity->day2Date = $dto->forecast->day2->date;
        $entity->day2Temp = $dto->forecast->day2->temperature;
        $entity->day3Date = $dto->forecast->day3->date;
        $entity->day3Temp = $dto->forecast->day3->temperature;
        $entity->day4Date = $dto->forecast->day4->date;
        $entity->day4Temp = $dto->forecast->day4->temperature;
        $entity->day5Date = $dto->forecast->day5->date;
        $entity->day5Temp = $dto->forecast->day5->temperature;

        return $entity;
    }

    public function createDtoFromEntity(WeatherEntityInterface $entity): WeatherDto
    {
        $locationDto = new LocationDto();
        $locationDto->stationName = $entity->getStationName();
        $locationDto->region = $entity->getRegion();
        $locationDto->lat = $entity->getLat();
        $locationDto->lon = $entity->getLon();

        $ratingDto = new WeatherRatingDto();
        $ratingDto->temperatureRating = new Rating($entity->getTemperatureRating());
        $ratingDto->rainRating = new Rating($entity->getRainRating());
        $ratingDto->windRating = new Rating($entity->getWindRating());
        $ratingDto->averageRating = new Rating($entity->getAverageRating());

        $day1 = new ForecastDayDto();
        $day1->date = $entity->getDay1Date();
        $day1->temperature = $entity->getDay1Temp();

        $day2 = new ForecastDayDto();
        $day2->date = $entity->getDay2Date();
        $day2->temperature = $entity->getDay2Temp();

        $day3 = new ForecastDayDto();
        $day3->date = $entity->getDay3Date();
        $day3->temperature = $entity->getDay3Temp();

        $day4 = new ForecastDayDto();
        $day4->date = $entity->getDay4Date();
        $day4->temperature = $entity->getDay4Temp();

        $day5 = new ForecastDayDto();
        $day5->date = $entity->getDay5Date();
        $day5->temperature = $entity->getDay5Temp();

        $forecastDto = new ForecastDto();
        $forecastDto->day1 = $day1;
        $forecastDto->day2 = $day2;
        $forecastDto->day3 = $day3;
        $forecastDto->day4 = $day4;
        $forecastDto->day5 = $day5;

        $dto = new WeatherDto();
        $dto->date = $entity->getDate();
        $dto->temperature = $entity->getTemperature();
        $dto->windSpeed = $entity->getWindSpeed();
        $dto->windDirection = $entity->getWindDirection();
        $dto->rain = $entity->getRain();
        $dto->background = $entity->getBackground();
        $dto->summary = $entity->getSummary();
        $dto->location = $locationDto;
        $dto->rating = $ratingDto;
        $dto->forecast = $forecastDto;

        return $dto;
    }
}
