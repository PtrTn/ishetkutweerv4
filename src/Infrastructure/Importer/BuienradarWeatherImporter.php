<?php

declare(strict_types=1);

namespace App\Infrastructure\Importer;

use App\Application\Importer\WeatherImporterInterface;
use App\Domain\Model\WeatherReportCollection;
use App\Infrastructure\ApiClient\BuienradarApiClientInterface;
use App\Infrastructure\Factory\WeatherReportCollectionFactoryInterface;

final class BuienradarWeatherImporter implements WeatherImporterInterface
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

    public function import(): WeatherReportCollection
    {
        $data = $this->apiClient->getData();

        return $this->dtoFactory->create($data);
    }
}
