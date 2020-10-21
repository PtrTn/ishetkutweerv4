<?php

declare(strict_types=1);

namespace App\Infrastructure\Importer;

use App\Application\Importer\WeatherImporterInterface;
use App\Domain\Model\WeatherReportCollection;
use App\Infrastructure\ApiClient\BuienradarApiClient;
use App\Infrastructure\Factory\WeatherReportCollectionFactory;

final class BuienradarWeatherImporter implements WeatherImporterInterface
{
    private BuienradarApiClient $apiClient;

    private WeatherReportCollectionFactory $dtoFactory;

    public function __construct(
        BuienradarApiClient $apiClient,
        WeatherReportCollectionFactory $dtoFactory
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
