<?php

namespace App\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class AlotRainRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->rain > 10;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        return WeatherRatingEnum::kut();
    }
}
