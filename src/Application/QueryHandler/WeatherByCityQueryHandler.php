<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Query\WeatherByCityQuery;
use App\Application\Repository\CityRepositoryInterface;
use App\Application\Repository\WeatherReportCollectionRepositoryInterface;
use App\Application\Service\DistanceService;
use App\Domain\Model\WeatherReport;
use RuntimeException;

class WeatherByCityQueryHandler
{
    private WeatherReportCollectionRepositoryInterface $weatherReportCollectionRepository;
    private CityRepositoryInterface $cityRepository;
    private DistanceService $distanceService;

    public function __construct(
        WeatherReportCollectionRepositoryInterface $weatherReportCollectionRepository,
        CityRepositoryInterface $cityRepository,
        DistanceService $distanceService
    ) {
        $this->weatherReportCollectionRepository = $weatherReportCollectionRepository;
        $this->cityRepository = $cityRepository;
        $this->distanceService = $distanceService;
    }

    public function handle(WeatherByCityQuery $query): WeatherReport
    {
        $city = $this->cityRepository->getByName($query->city);
        $weatherReports = $this->weatherReportCollectionRepository->getLatest();

        $weatherReport = $this->distanceService->findClosestWeatherReport($weatherReports, $city->getLat(), $city->getLon());
        if ($weatherReport === null) {
            throw new RuntimeException('Unable to find weather for city');
        }

        return $weatherReport;
    }
}
