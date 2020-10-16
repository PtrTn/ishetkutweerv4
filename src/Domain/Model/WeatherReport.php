<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class WeatherReport
{
    private CurrentWeather $currentWeather;
    private Description $description;
    private Forecast $forecast;
    private WeatherRating $rating;
    private Location $location;
    private ReportDateTime $dateTime;

    public function __construct(
        CurrentWeather $currentWeather,
        Description $description,
        Forecast $forecast,
        WeatherRating $rating,
        Location $location,
        ReportDateTime $dateTime
    ) {
        $this->currentWeather = $currentWeather;
        $this->description = $description;
        $this->forecast = $forecast;
        $this->rating = $rating;
        $this->location = $location;
        $this->dateTime = $dateTime;
    }

    public function getCurrentWeather(): CurrentWeather
    {
        return $this->currentWeather;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getForecast(): Forecast
    {
        return $this->forecast;
    }

    public function getRating(): WeatherRating
    {
        return $this->rating;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function getDateTime(): ReportDateTime
    {
        return $this->dateTime;
    }
}
