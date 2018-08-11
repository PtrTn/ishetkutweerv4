<?php

namespace App\Domain\Rule\Wind;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class SomeWindRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->windSpeed > 4;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        return WeatherRatingEnum::beetjeKut();
    }
}
