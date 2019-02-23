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


    public function isFreezing(): bool
    {
        return $this->temperature !== null && $this->temperature < 0;
    }

    public function hasShowers(): bool
    {
        return $this->rain !== NULL && $this->rain > 0;
    }

    public function hasRain(): bool
    {
        return $this->rain !== NULL && $this->rain > 5;
    }

    public function hasSnow(): bool
    {
        return $this->hasShowers() && $this->isFreezing();
    }

    public function hasBreeze(): bool
    {
        return $this->windSpeed > 3;
    }

    public function hasWind(): bool
    {
        return $this->windSpeed > 7;
    }
}
