<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Importer\WeatherImporterInterface;
use App\Application\Repository\WeatherReportCollectionRepositoryInterface;

class WeatherCommandHandler
{
    private WeatherImporterInterface $weatherImporter;

    private WeatherReportCollectionRepositoryInterface $weatherReportCollectionRepository;

    public function __construct(
        WeatherImporterInterface $weatherImporter,
        WeatherReportCollectionRepositoryInterface $weatherReportCollectionRepository
    ) {
        $this->weatherImporter = $weatherImporter;
        $this->weatherReportCollectionRepository = $weatherReportCollectionRepository;
    }

    public function storeWeatherData(): void
    {
        $weatherReportCollection = $this->weatherImporter->import();
        $this->weatherReportCollectionRepository->store($weatherReportCollection);
    }
}
