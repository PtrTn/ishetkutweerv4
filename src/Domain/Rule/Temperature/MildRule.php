<?php

declare(strict_types=1);

namespace App\Domain\Rule\Temperature;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

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
