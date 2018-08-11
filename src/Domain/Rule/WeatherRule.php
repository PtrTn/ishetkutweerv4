<?php

namespace App\Domain\Rule;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;

interface WeatherRule
{
    public function matches(WeatherDto $dto): bool;

    public function getRating(WeatherDto $dto): WeatherRatingEnum;
}
