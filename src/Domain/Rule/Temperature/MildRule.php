<?php

namespace App\Domain\Rule\Temperature;

use App\Domain\Dto\WeatherDto;
use App\Domain\ValueObject\Rating;
use App\Domain\Rule\WeatherRule;

class MildRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return isset($dto->temperature) && $dto->temperature < 10;
    }

    public function getRating(WeatherDto $dto): Rating
    {
        return Rating::beetjeKut();
    }
}
