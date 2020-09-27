<?php

namespace App\Application\Mapper;

use App\Application\Entity\WeatherEntityInterface;
use App\Domain\Dto\WeatherDto;

interface WeatherEntityMapperInterface
{
    public function createEntityFromDto(WeatherDto $dto): WeatherEntityInterface;
    
    public function createDtoFromEntity(WeatherEntityInterface $entity): WeatherDto;
}
