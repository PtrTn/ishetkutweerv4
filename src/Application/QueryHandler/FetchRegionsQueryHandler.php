<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Dto\RegionDto;
use App\Application\Mapper\WeatherEntityToCityDtoMapperInterface;
use App\Application\Repository\WeatherReportCollectionRepositoryInterface;

class FetchRegionsQueryHandler
{
    private WeatherReportCollectionRepositoryInterface $repository;

    private WeatherEntityToCityDtoMapperInterface $mapper;

    public function __construct(
        WeatherReportCollectionRepositoryInterface $repository,
        WeatherEntityToCityDtoMapperInterface $mapper
    ) {
        $this->repository = $repository;
        $this->mapper = $mapper;
    }

    /** @return RegionDto[] */
    public function handle(): array
    {
        $weatherReportCollection = $this->repository->getLatest();
        $dtos = [];
        foreach ($weatherReportCollection->getWeatherReports() as $weatherReport) {
            $dtos[] = $this->mapper->createDtoFromEntity($weatherReport);
        }

        return $dtos;
    }
}
