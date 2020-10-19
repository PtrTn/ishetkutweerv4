<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Domain\Model\Cities;
use App\Domain\Model\City;
use App\Infrastructure\Entity\CityEntity;
use ArrayIterator;
use Generator;

class CityEntityMapper implements CityEntityMapperInterface
{
    /** @param CityEntity[] $entities */
    public function createModelFromEntities(array $entities): Cities
    {
        $models = [];
        foreach ($entities as $entity) {
            $models[] = $this->createModelFromEntity($entity);
        }

        return new Cities(new ArrayIterator($models));
    }

    public function createModelFromEntity(CityEntity $entity): City
    {
        return new City(
            $entity->cityName,
            $entity->latitude,
            $entity->longitude,
            $entity->postcodeNumbers,
            $entity->postcodeCharacters
        );
    }

    public function createEntitiesFromModels(Cities $cities): Generator
    {
        foreach ($cities as $city) {
            yield $this->createEntityFromModel($city);
        }
    }

    private function createEntityFromModel(City $city): CityEntity
    {
        $entity = new CityEntity();
        $entity->cityName = $city->getName();
        $entity->latitude = $city->getLat();
        $entity->longitude = $city->getLon();
        $entity->postcodeNumbers = $city->getPostcodeNumbers();
        $entity->postcodeCharacters = $city->getPostcodeCharacters();

        return $entity;
    }
}
