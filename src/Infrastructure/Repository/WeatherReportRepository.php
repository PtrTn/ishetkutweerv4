<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\WeatherReportRepositoryInterface;
use App\Domain\Model\WeatherReport;
use App\Infrastructure\Mapper\WeatherEntityMapperInterface;

final class WeatherReportRepository implements WeatherReportRepositoryInterface
{
    private WeatherEntityRepositoryInterface $entityRepository;

    private WeatherEntityMapperInterface $entityMapper;

    public function __construct(
        WeatherEntityRepositoryInterface $entityRepository,
        WeatherEntityMapperInterface $entityMapper
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityMapper = $entityMapper;
    }

    public function getLatestWeatherReportForLocation(string $location): ?WeatherReport
    {
        $entity = $this->entityRepository->findLatestEntityForLocation($location);
        if ($entity === null) {
            return null;
        }

        return $this->entityMapper->createWeatherReportFromEntity($entity);
    }
}
