<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Importer\WeatherImporterInterface;
use App\Application\Repository\WeatherReportCollectionRepositoryInterface;

class WeatherCommandHandler
{
    private WeatherImporterInterface $weatherFetchService;

    private WeatherReportCollectionRepositoryInterface $weatherStorageService;

    public function __construct(
        WeatherImporterInterface $weatherFetchService,
        WeatherReportCollectionRepositoryInterface $weatherStorageService
    ) {
        $this->weatherFetchService = $weatherFetchService;
        $this->weatherStorageService = $weatherStorageService;
    }

    public function storeWeatherData(): void
    {
        $weatherReportCollection = $this->weatherFetchService->import();
        $this->weatherStorageService->store($weatherReportCollection);
    }
}
