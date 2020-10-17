<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Importer\CityImporterInterface;

class CityCommandHandler
{
    private CityImporterInterface $cityImporter;

    public function __construct(CityImporterInterface $cityImporter)
    {
        $this->cityImporter = $cityImporter;
    }

    public function storeCityData(): void
    {
        $this->cityImporter->import();
    }
}
