<?php

declare(strict_types=1);

namespace App\Domain\Rule\Rain;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

class SomeRainRule implements WeatherRule
{
    public function matches(CurrentWeather $currentWeather): bool
    {
        return $currentWeather->getRain() > 0;
    }

    public function getRating(): Rating
    {
        return Rating::beetjeKut();
    }
}
