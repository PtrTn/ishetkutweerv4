<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\CityRepositoryInterface;
use App\Domain\Model\Cities;
use App\Domain\Model\City;
use App\Infrastructure\Mapper\CityEntityMapper;

final class CityRepository implements CityRepositoryInterface
{
    private CityEntityRepository $entityRepository;
    private CityEntityMapper $entityMapper;

    public function __construct(
        CityEntityRepository $entityRepository,
        CityEntityMapper $entityMapper
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityMapper = $entityMapper;
    }

    public function getAllCities(): Cities
    {
        $entities = $this->entityRepository->getAllCities();

        return $this->entityMapper->createModelFromEntities($entities);
    }

    public function getByName(string $cityName): City
    {
        $city = $this->entityRepository->getByName($cityName);

        return $this->entityMapper->createModelFromEntity($city);
    }

    public function store(Cities $cities): void
    {
        $entities = $this->entityMapper->createEntitiesFromModels($cities);
        $this->entityRepository->saveEntities($entities);
    }
}
