<?php

namespace App\Domain\Rule\Temperature;

use App\Domain\Dto\WeatherDto;
use App\Domain\ValueObject\Rating;
use App\Domain\Rule\WeatherRule;

class TooHotOrColdRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        if (!isset($dto->temperature)) {
            return false;
        }
        return $dto->temperature > 30 || $dto->temperature < 0;
    }

    public function getRating(WeatherDto $dto): Rating
    {
        return Rating::kut();
    }
}
