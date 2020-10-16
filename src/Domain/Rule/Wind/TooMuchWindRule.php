<?php

declare(strict_types=1);

namespace App\Domain\Rule\Wind;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

class TooMuchWindRule implements WeatherRule
{
    public function matches(CurrentWeather $currentWeather): bool
    {
        return $currentWeather->getWindSpeed() > 9;
    }

    public function getRating(): Rating
    {
        return Rating::megaKut();
    }
}
