<?php

namespace App\Application\QueryHandler;

use App\Application\ApiClient\BuienradarApiClientInterface;
use App\Application\Assembler\WeatherDtoAssemblerInterface;
use App\Application\Factory\WeatherDtoFactoryInterface;
use App\Application\Query\WeatherDataQuery;
use App\Application\Service\BuienradarDistanceService;
use App\Domain\Dto\WeatherDto;

class WeatherQueryHandler
{
    /**
     * @var BuienradarApiClientInterface
     */
    private $apiClient;

    /**
     * @var BuienradarDistanceService
     */
    private $distanceService;

    /**
     * @var WeatherDtoFactoryInterface
     */
    private $factory;

    /**
     * @var WeatherDtoAssemblerInterface
     */
    private $assembler;

    public function __construct(
        BuienradarApiClientInterface $apiClient,
        BuienradarDistanceService $distanceService,
        WeatherDtoFactoryInterface $factory,
        WeatherDtoAssemblerInterface $assembler
    ) {
        $this->apiClient = $apiClient;
        $this->distanceService = $distanceService;
        $this->factory = $factory;
        $this->assembler = $assembler;
    }

    public function getWeatherData(WeatherDataQuery $query): WeatherDto
    {
        $data = $this->apiClient->getData();
        $station = $this->distanceService->getClosestWeerstation($query->lat, $query->lon, $data);
        $dto = $this->factory->createFromWeerstationDto($station);
        return $this->assembler->assemble($dto);
    }
}
