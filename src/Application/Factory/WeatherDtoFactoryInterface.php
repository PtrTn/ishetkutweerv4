<?php

namespace App\Application\Factory;

use App\Application\Dto\Buienradar\WeerstationDto;
use App\Domain\Dto\WeatherDto;

interface WeatherDtoFactoryInterface
{
    public function createFromWeerstationDto(WeerstationDto $weerstationDto): WeatherDto;
}
