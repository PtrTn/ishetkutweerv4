<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Application\Dto\RegionDto;
use App\Application\Entity\WeatherEntityInterface;
use App\Application\Mapper\WeatherEntityToCityDtoMapperInterface;

class WeatherEntityToCityDtoMapper implements WeatherEntityToCityDtoMapperInterface
{
    public function createDtoFromEntity(WeatherEntityInterface $entity): RegionDto
    {
        $dto = new RegionDto();
        $dto->region = $entity->getRegion();

        return $dto;
    }
}
