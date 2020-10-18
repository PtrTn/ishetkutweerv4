<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\CityRepositoryInterface;
use App\Domain\Model\Cities;
use App\Domain\Model\City;
use App\Infrastructure\Mapper\CityEntityMapperInterface;

final class CityRepository implements CityRepositoryInterface
{
    private CityEntityRepositoryInterface $entityRepository;
    private CityEntityMapperInterface $entityMapper;

    public function __construct(
        CityEntityRepositoryInterface $entityRepository,
        CityEntityMapperInterface $entityMapper
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
}
