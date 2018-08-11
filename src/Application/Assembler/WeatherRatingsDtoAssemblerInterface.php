<?php

namespace App\Application\Assembler;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingsDto;

interface WeatherRatingsDtoAssemblerInterface
{
    public function assemble(WeatherDto $dto): WeatherRatingsDto;
}
