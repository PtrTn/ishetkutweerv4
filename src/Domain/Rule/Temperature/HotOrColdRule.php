<?php

declare(strict_types=1);

namespace App\Domain\Rule\Temperature;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

class HotOrColdRule implements WeatherRule
{
    public function matches(CurrentWeather $currentWeather): bool
    {
        return $currentWeather->getTemperature() > 30 || $currentWeather->getTemperature() < 0;
    }

    public function getRating(): Rating
    {
        return Rating::kut();
    }
}
