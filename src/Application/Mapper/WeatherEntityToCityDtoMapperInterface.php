<?php

declare(strict_types=1);

namespace App\Application\Mapper;

use App\Application\Dto\RegionDto;
use App\Application\Entity\WeatherEntityInterface;

interface WeatherEntityToCityDtoMapperInterface
{
    public function createDtoFromEntity(WeatherEntityInterface $entity): RegionDto;
}
