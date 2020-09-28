<?php

declare(strict_types=1);

namespace App\Domain\Dto;

use DateTimeImmutable;

class WeatherDto
{
    public LocationDto $location;

    public DateTimeImmutable $date;

    public ?float $temperature = null;

    public ?float $rain = null;

    public ?float $windSpeed = null;

    public string $windDirection;

    public WeatherRatingDto $rating;

    public string $summary;

    public ForecastDto $forecast;

    public string $background;

    public function isFreezing(): bool
    {
        return $this->temperature !== null && $this->temperature < 0;
    }

    public function hasShowers(): bool
    {
        return $this->rain !== null && $this->rain > 0;
    }

    public function hasRain(): bool
    {
        return $this->rain !== null && $this->rain > 5;
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
