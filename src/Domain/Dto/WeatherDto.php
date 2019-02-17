<?php

namespace App\Domain\Dto;

use DateTimeImmutable;

class WeatherDto
{
    /**
     * @var LocationDto
     */
    public $location;

    /**
     * @var DateTimeImmutable
     */
    public $date;

    /**
     * @var float|null
     */
    public $temperature;

    /**
     * @var float|null
     */
    public $rain;

    /**
     * @var float|null
     */
    public $windSpeed;

    /**
     * @var string
     */
    public $windDirection;

    /**
     * @var WeatherRatingDto
     */
    public $rating;

    /**
     * @var string
     */
    public $summary;

    /**
     * @var ForecastDto
     */
    public $forecast;

    /**
     * @var string
     */
    public $background;
}
