<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Exception\SorryWeatherNotFound;
use App\Application\Query\WeatherByLatLonQuery;
use App\Application\Repository\WeatherReportCollectionRepositoryInterface;
use App\Application\Service\DistanceService;
use App\Domain\Model\WeatherReport;

class WeatherByLatLonQueryHandler
{
    private WeatherReportCollectionRepositoryInterface $weatherReportCollectionRepository;

    private DistanceService $distanceService;

    public function __construct(
        WeatherReportCollectionRepositoryInterface $weatherReportCollectionRepository,
        DistanceService $distanceService
    ) {
        $this->weatherReportCollectionRepository = $weatherReportCollectionRepository;
        $this->distanceService = $distanceService;
    }

    public function handle(WeatherByLatLonQuery $query): WeatherReport
    {
        $weatherReports = $this->weatherReportCollectionRepository->getLatest();

        $weatherReport = $this->distanceService->findClosestWeerstation($weatherReports, $query->lat, $query->lon);
        if ($weatherReport === null) {
            throw new SorryWeatherNotFound('Unable to find weather data');
        }

        return $weatherReport;
    }
}
