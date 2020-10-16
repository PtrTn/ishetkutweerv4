<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Model\WeatherReportCollection;
use App\Infrastructure\Dto\Buienradar\BuienradarnlDto;
use InvalidArgumentException;

class WeatherReportCollectionFactory implements WeatherReportCollectionFactoryInterface
{
    private WeatherReportFactory $weatherReportFactory;

    public function __construct(WeatherReportFactory $weatherDtoFactory)
    {
        $this->weatherReportFactory = $weatherDtoFactory;
    }

    public function create(BuienradarnlDto $buienradarnlDto): WeatherReportCollection
    {
        $verwachtingVandaag = $buienradarnlDto->weergegevens->verwachting_vandaag;
        $verwachtingMeerdaags = $buienradarnlDto->weergegevens->verwachting_meerdaags;

        $weatherReports = [];
        foreach ($buienradarnlDto->weergegevens->actueel_weer->weerstations as $weerstationDto) {
            try {
                $weatherReports[] = $this->weatherReportFactory->create(
                    $verwachtingVandaag,
                    $verwachtingMeerdaags,
                    $weerstationDto
                );
            } catch (InvalidArgumentException $exception) {
                // todo, log any errors.
            }
        }

        return new WeatherReportCollection($weatherReports);
    }
}
