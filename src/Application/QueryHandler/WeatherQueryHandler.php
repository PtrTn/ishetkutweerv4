<?php

namespace App\Application\QueryHandler;

use App\Application\ApiClient\BuienradarApiClientInterface;
use App\Application\Factory\WeatherDtoFactory;
use App\Application\Factory\WeatherDtoFactoryInterface;
use App\Application\Query\WeatherDataQuery;
use App\Application\Service\DistanceService;
use App\Application\Dto\Buienradar\BuienradarnlDto;
use App\Application\Dto\Buienradar\WeerstationDto;
use App\Domain\Dto\WeatherDto;

class WeatherQueryHandler
{
    /**
     * @var BuienradarApiClientInterface
     */
    private $apiClient;

    /**
     * @var DistanceService
     */
    private $distanceService;

    /**
     * @var WeatherDtoFactoryInterface
     */
    private $factory;

    public function __construct(
        BuienradarApiClientInterface $apiClient,
        DistanceService $distanceService,
        WeatherDtoFactoryInterface $factory
    ) {
        $this->apiClient = $apiClient;
        $this->distanceService = $distanceService;
        $this->factory = $factory;
    }

    public function getWeatherData(WeatherDataQuery $query): WeatherDto
    {
        $data = $this->apiClient->getData();
        $station = $this->getClosestWeerstation($query->lat, $query->lon, $data);
        return $this->factory->createFromWeerstationDto($station);
    }

    private function getClosestWeerstation(float $latA, float $lonA, BuienradarnlDto $data): ?WeerstationDto
    {
        $closestStation = null;
        $closestDistance = null;
        foreach ($data->weergegevens->actueel_weer->weerstations as $weerstation) {
            $distance = $this->distanceService->getDistance(
                $latA,
                $lonA,
                floatval($weerstation->lat),
                floatval($weerstation->lon)
            );
            if (!isset($closestDistance) || $distance < $closestDistance) {
                $closestDistance = $distance;
                $closestStation = $weerstation;
            }
        }
        return $closestStation;
    }
}
