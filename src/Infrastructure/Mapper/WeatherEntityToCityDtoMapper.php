<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Application\Dto\RegionDto;
use App\Application\Mapper\WeatherEntityToCityDtoMapperInterface;
use App\Domain\Model\WeatherReport;

class WeatherEntityToCityDtoMapper implements WeatherEntityToCityDtoMapperInterface
{
    public function createDtoFromEntity(WeatherReport $weatherReport): RegionDto
    {
        $dto = new RegionDto();
        $dto->region = $weatherReport->getLocation()->getName();

        return $dto;
    }
}
