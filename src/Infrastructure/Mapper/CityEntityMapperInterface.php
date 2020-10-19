<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Domain\Model\Cities;
use App\Domain\Model\City;
use App\Infrastructure\Entity\CityEntity;
use Generator;

interface CityEntityMapperInterface
{
    /** @param CityEntity[] $entities */
    public function createModelFromEntities(array $entities): Cities;

    public function createModelFromEntity(CityEntity $entity): City;

    public function createEntitiesFromModels(Cities $cities): Generator;
}
