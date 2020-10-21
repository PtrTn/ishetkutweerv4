<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\WeatherReportCollectionRepositoryInterface;
use App\Domain\Model\WeatherReportCollection;
use App\Infrastructure\Mapper\WeatherEntityMapper;

final class WeatherReportCollectionRepository implements WeatherReportCollectionRepositoryInterface
{
    private WeatherEntityRepository $entityRepository;
    private WeatherEntityMapper $entityMapper;

    public function __construct(
        WeatherEntityRepository $entityRepository,
        WeatherEntityMapper $entityMapper
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityMapper = $entityMapper;
    }

    public function store(WeatherReportCollection $weatherReportCollection): void
    {
        $entities = [];
        foreach ($weatherReportCollection->toArray() as $weatherReport) {
            $entities[] = $this->entityMapper->createEntityFromWeatherReport($weatherReport);
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
