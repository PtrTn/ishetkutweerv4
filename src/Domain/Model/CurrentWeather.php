<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class CurrentWeather
{
    private float $temperature;

    private float $rain;

    private float $windSpeed;

    private int $windDirection;

    public function __construct(
        float $temperature,
        float $rain,
        float $windSpeed,
        int $windDirection
    ) {
        $this->temperature = $temperature;
        $this->rain = $rain;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getRain(): float
    {
        return $this->rain;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    public function getWindDirection(): int
    {
        return $this->windDirection;
    }

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
