<?php

namespace App\Application\Factory;

use App\Application\Dto\Buienradar\VerwachtingMeerdaags;
use App\Application\Dto\Buienradar\VerwachtingVandaag;
use App\Application\Dto\Buienradar\WeerstationDto;
use App\Domain\Dto\WeatherDto;

interface WeatherDtoFactoryInterface
{
    public function create(
        VerwachtingVandaag $verwachtingVandaag,
        VerwachtingMeerdaags $verwachtingMeerdaags,
        WeerstationDto $weerstationDto
    ): WeatherDto;
}
