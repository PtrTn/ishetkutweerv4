<?php

namespace App\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class SomeRainRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->rain > 0;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        return WeatherRatingEnum::beetjeKut();
    }
}
