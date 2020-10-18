<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Domain\Model\Cities;
use App\Domain\Model\City;
use App\Infrastructure\Entity\CityEntity;

interface CityEntityMapperInterface
{
    /** @param CityEntity[] $entities */
    public function createModelFromEntities(array $entities): Cities;

    public function createModelFromEntity(CityEntity $entity): City;
}
