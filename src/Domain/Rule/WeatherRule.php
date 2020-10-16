<?php

declare(strict_types=1);

namespace App\Domain\Rule;

use App\Domain\Model\CurrentWeather;
use App\Domain\ValueObject\Rating;

interface WeatherRule
{
    public function matches(CurrentWeather $currentWeather): bool;

    public function getRating(): Rating;
}
