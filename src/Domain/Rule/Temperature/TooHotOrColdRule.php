<?php

declare(strict_types=1);

namespace App\Domain\Rule\Temperature;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

class TooHotOrColdRule implements WeatherRule
{
    public function matches(CurrentWeather $currentWeather): bool
    {
        return $currentWeather->getTemperature() > 35 || $currentWeather->getTemperature() < -10;
    }

    public function getRating(): Rating
    {
        return Rating::megaKut();
    }
}
