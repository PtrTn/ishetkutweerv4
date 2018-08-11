<?php

namespace App\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\ValueObject\Rating;
use App\Domain\Rule\WeatherRule;

class TooMuchRainRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->rain > 30;
    }

    public function getRating(WeatherDto $dto): Rating
    {
        return Rating::megaKut();
    }
}
