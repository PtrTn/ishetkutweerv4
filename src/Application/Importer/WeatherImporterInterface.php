<?php

declare(strict_types=1);

namespace App\Application\Importer;

use App\Domain\Model\WeatherReportCollection;

interface WeatherImporterInterface
{
    public function import(): WeatherReportCollection;
}
