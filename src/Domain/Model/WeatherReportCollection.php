<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class WeatherReportCollection
{
    /** @var WeatherReport[] */
    private array $weatherReports;

    /** @param WeatherReport[] $weatherReports */
    public function __construct(array $weatherReports)
    {
        $this->weatherReports = $weatherReports;
    }

    /** @return WeatherReport[] */
    public function toArray(): array
    {
        return $this->weatherReports;
    }
}
