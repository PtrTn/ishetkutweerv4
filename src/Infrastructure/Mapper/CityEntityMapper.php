<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Domain\Model\Cities;
use App\Domain\Model\City;
use App\Infrastructure\Entity\CityEntity;

class CityEntityMapper implements CityEntityMapperInterface
{
    /** @param CityEntity[] $entities */
    public function createModelFromEntities(array $entities): Cities
    {
        $models = [];
        foreach ($entities as $entity) {
            $models[] = $this->createModelFromEntity($entity);
        }

        return new Cities($models);
    }

    public function createModelFromEntity(CityEntity $entity): City
    {
        return new City($entity->cityName, $entity->latitude, $entity->longitude);
    }
}
