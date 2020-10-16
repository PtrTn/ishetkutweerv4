<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Query\WeatherByLocationQuery;
use App\Application\Repository\WeatherReportRepositoryInterface;
use App\Domain\Model\WeatherReport;
use InvalidArgumentException;

use function sprintf;

class WeatherByLocationQueryHandler
{
    private WeatherReportRepositoryInterface $weatherRepository;

    public function __construct(WeatherReportRepositoryInterface $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function handle(WeatherByLocationQuery $query): WeatherReport
    {
        $weatherReport = $this->weatherRepository->getLatestWeatherReportForLocation($query->location);

        if ($weatherReport === null) {
            throw new InvalidArgumentException(sprintf('Unknown location "%s"', $query->location));
        }

        return $weatherReport;
    }
}
