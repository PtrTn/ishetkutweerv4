<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\WeatherReportCollectionRepositoryInterface;
use App\Domain\Model\WeatherReportCollection;
use App\Infrastructure\Mapper\WeatherEntityMapperInterface;

final class WeatherReportCollectionRepository implements WeatherReportCollectionRepositoryInterface
{
    private WeatherEntityMapperInterface $entityFactory;

    private WeatherEntityRepositoryInterface $entityRepository;
    private WeatherEntityMapperInterface $entityMapper;

    public function __construct(
        WeatherEntityMapperInterface $entityFactory,
        WeatherEntityRepositoryInterface $entityRepository,
        WeatherEntityMapperInterface $entityMapper
    ) {
        $this->entityFactory = $entityFactory;
        $this->entityRepository = $entityRepository;
        $this->entityMapper = $entityMapper;
    }

    public function store(WeatherReportCollection $weatherReportCollection): void
    {
        $entities = [];
        foreach ($weatherReportCollection->toArray() as $weatherReport) {
            $entities[] = $this->entityFactory->createEntityFromWeatherReport($weatherReport);
        }

        $this->entityRepository->saveEntities($entities);
    }

    public function getLatest(): WeatherReportCollection
    {
        $entities = $this->entityRepository->getLatestEntites();
        $weatherReports = [];
        foreach ($entities as $entity) {
            $weatherReports[] = $this->entityMapper->createWeatherReportFromEntity($entity);
        }

        return new WeatherReportCollection($weatherReports);
    }
}
