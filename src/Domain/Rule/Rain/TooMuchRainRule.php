<?php

namespace App\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class TooMuchRainRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->rain > 30;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        return WeatherRatingEnum::megaKut();
    }
}
