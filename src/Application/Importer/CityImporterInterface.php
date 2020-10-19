<?php

declare(strict_types=1);

namespace App\Application\Importer;

use App\Domain\Model\Cities;

interface CityImporterInterface
{
    public function import(): Cities;
}
