<?php

declare(strict_types=1);

namespace App\Application\Mapper;

use App\Application\Dto\RegionDto;
use App\Domain\Model\WeatherReport;

interface WeatherEntityToCityDtoMapperInterface
{
    public function createDtoFromEntity(WeatherReport $weatherReport): RegionDto;
}
