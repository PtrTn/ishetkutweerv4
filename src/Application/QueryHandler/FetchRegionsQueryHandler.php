<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Dto\RegionDto;
use App\Application\Mapper\WeatherEntityToCityDtoMapperInterface;
use App\Application\Repository\WeatherEntityRepositoryInterface;

class FetchRegionsQueryHandler
{
    private WeatherEntityRepositoryInterface $repository;

    private WeatherEntityToCityDtoMapperInterface $mapper;

    public function __construct(
        WeatherEntityRepositoryInterface $repository,
        WeatherEntityToCityDtoMapperInterface $mapper
    ) {
        $this->repository = $repository;
        $this->mapper = $mapper;
    }

    /** @return RegionDto[] */
    public function handle(): array
    {
        $entities = $this->repository->getLatestEntites();
        $dtos = [];
        foreach ($entities as $entity) {
            $dtos[] = $this->mapper->createDtoFromEntity($entity);
        }

        return $dtos;
    }
}
