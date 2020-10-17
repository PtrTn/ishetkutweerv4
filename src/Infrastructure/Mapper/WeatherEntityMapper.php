<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Domain\Model\CurrentWeather;
use App\Domain\Model\Description;
use App\Domain\Model\Forecast;
use App\Domain\Model\ForecastDay;
use App\Domain\Model\Location;
use App\Domain\Model\ReportDateTime;
use App\Domain\Model\WeatherRating;
use App\Domain\Model\WeatherReport;
use App\Domain\ValueObject\Rating;
use App\Infrastructure\Entity\WeatherEntity;

class WeatherEntityMapper implements WeatherEntityMapperInterface
{
    public function createEntityFromWeatherReport(WeatherReport $weatherReport): WeatherEntity
    {
        $entity = new WeatherEntity();
        $entity->location = $weatherReport->getLocation()->getName();
        $entity->lat = $weatherReport->getLocation()->getLat();
        $entity->lon = $weatherReport->getLocation()->getLon();
        $entity->temperature = $weatherReport->getCurrentWeather()->getTemperature();
        $entity->windSpeed = $weatherReport->getCurrentWeather()->getWindSpeed();
        $entity->windDirection = $weatherReport->getCurrentWeather()->getWindDirection();
        $entity->rain = $weatherReport->getCurrentWeather()->getRain();
        $entity->temperatureRating = $weatherReport->getRating()->getTemperatureRating()->getRating();
        $entity->rainRating = $weatherReport->getRating()->getRainRating()->getRating();
        $entity->windRating = $weatherReport->getRating()->getWindRating()->getRating();
        $entity->averageRating = $weatherReport->getRating()->getAverageRating()->getRating();
        $entity->description = $weatherReport->getDescription()->toString();
        $entity->day1Date = $weatherReport->getForecast()->getDay1()->getDate();
        $entity->day1Temp = $weatherReport->getForecast()->getDay1()->getTemperature();
        $entity->day2Date = $weatherReport->getForecast()->getDay2()->getDate();
        $entity->day2Temp = $weatherReport->getForecast()->getDay2()->getTemperature();
        $entity->day3Date = $weatherReport->getForecast()->getDay3()->getDate();
        $entity->day3Temp = $weatherReport->getForecast()->getDay3()->getTemperature();
        $entity->day4Date = $weatherReport->getForecast()->getDay4()->getDate();
        $entity->day4Temp = $weatherReport->getForecast()->getDay4()->getTemperature();
        $entity->day5Date = $weatherReport->getForecast()->getDay5()->getDate();
        $entity->day5Temp = $weatherReport->getForecast()->getDay5()->getTemperature();
        $entity->dateTime = $weatherReport->getDateTime()->toDateTimeImmutable();

        return $entity;
    }

    public function createWeatherReportFromEntity(WeatherEntity $entity): WeatherReport
    {
        $currentWeather = new CurrentWeather(
            $entity->getTemperature(),
            $entity->getRain(),
            $entity->getWindSpeed(),
            $entity->getWindDirection()
        );
        $description = new Description($entity->getDescription());

        $rating = new WeatherRating(
            new Rating($entity->getTemperatureRating()),
            new Rating($entity->getRainRating()),
            new Rating($entity->getWindRating()),
            new Rating($entity->getAverageRating())
        );

        $day1 = new ForecastDay($entity->getDay1Date(), $entity->getDay1Temp());
        $day2 = new ForecastDay($entity->getDay2Date(), $entity->getDay2Temp());
        $day3 = new ForecastDay($entity->getDay3Date(), $entity->getDay3Temp());
        $day4 = new ForecastDay($entity->getDay4Date(), $entity->getDay4Temp());
        $day5 = new ForecastDay($entity->getDay5Date(), $entity->getDay5Temp());
        $forecast = new Forecast($day1, $day2, $day3, $day4, $day5);

        $location = new Location(
            $entity->getLocation(),
            $entity->getLat(),
            $entity->getLon()
        );

        $dateTime = new ReportDateTime($entity->getDateTime());

        return new WeatherReport(
            $currentWeather,
            $description,
            $forecast,
            $rating,
            $location,
            $dateTime
        );
    }
}
