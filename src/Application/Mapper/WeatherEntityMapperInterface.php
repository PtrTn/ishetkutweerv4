<?php

namespace App\Application\Mapper;

use App\Domain\Dto\WeatherDto;
use App\Infrastructure\Entity\WeatherEntity;

interface WeatherEntityMapperInterface
{
    public function createEntityFromDto(WeatherDto $dto): WeatherEntity;
    
    public function createDtoFromEntity(WeatherEntity $entity): WeatherDto;
}
