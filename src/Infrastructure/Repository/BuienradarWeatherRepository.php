<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\WeatherRepositoryInterface;
use App\Domain\Model\WeatherReportCollection;
use App\Infrastructure\ApiClient\BuienradarApiClientInterface;
use App\Infrastructure\Factory\WeatherReportCollectionFactoryInterface;

final class BuienradarWeatherRepository implements WeatherRepositoryInterface
{
    private BuienradarApiClientInterface $apiClient;

    private WeatherReportCollectionFactoryInterface $dtoFactory;

    public function __construct(
        BuienradarApiClientInterface $apiClient,
        WeatherReportCollectionFactoryInterface $dtoFactory
    ) {
        $this->apiClient = $apiClient;
        $this->dtoFactory = $dtoFactory;
    }

    public function fetchWeather(): WeatherReportCollection
    {
        $data = $this->apiClient->getData();

        return $this->dtoFactory->create($data);
    }
}
