<?php

declare(strict_types=1);

namespace App\Application\Assembler;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingDto;

interface WeatherRatingsDtoAssemblerInterface
{
    public function assemble(WeatherDto $dto): WeatherRatingDto;
}
