<?php

declare(strict_types=1);

namespace App\Application\Importer;

interface CityImporterInterface
{
    public function import(): void;
}
