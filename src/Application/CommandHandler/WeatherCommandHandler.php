<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Repository\WeatherReportCollectionRepositoryInterface;
use App\Application\Repository\WeatherRepositoryInterface;

class WeatherCommandHandler
{
    private WeatherRepositoryInterface $weatherFetchService;

    private WeatherReportCollectionRepositoryInterface $weatherStorageService;

    public function __construct(
        WeatherRepositoryInterface $weatherFetchService,
        WeatherReportCollectionRepositoryInterface $weatherStorageService
    ) {
        $this->weatherFetchService = $weatherFetchService;
        $this->weatherStorageService = $weatherStorageService;
    }

    public function storeWeatherData(): void
    {
        $weatherReportCollection = $this->weatherFetchService->fetchWeather();
        $this->weatherStorageService->store($weatherReportCollection);
    }
}
