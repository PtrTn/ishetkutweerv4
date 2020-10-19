<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Importer\CityImporterInterface;
use App\Application\Repository\CityRepositoryInterface;

class CityCommandHandler
{
    private CityImporterInterface $cityImporter;
    private CityRepositoryInterface $cityRepository;

    public function __construct(CityImporterInterface $cityImporter, CityRepositoryInterface $cityRepository)
    {
        $this->cityImporter = $cityImporter;
        $this->cityRepository = $cityRepository;
    }

    public function storeCityData(): void
    {
        $cities = $this->cityImporter->import();
        $this->cityRepository->store($cities);
    }
}
