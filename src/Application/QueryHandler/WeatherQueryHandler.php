<?php

namespace App\Application\QueryHandler;

use App\Application\Mapper\WeatherEntityMapperInterface;
use App\Application\Query\WeatherDataQuery;
use App\Application\Repository\WeatherEntityRepositoryInterface;
use App\Application\Service\DistanceService;
use App\Domain\Dto\WeatherDto;

class WeatherQueryHandler
{
    /**
     * @var WeatherEntityRepositoryInterface
     */
    private $entityRepository;

    /**
     * @var WeatherEntityMapperInterface
     */
    private $entityMapper;

    /**
     * @var DistanceService
     */
    private $distanceService;

    public function __construct(
        WeatherEntityRepositoryInterface $entityRepository,
        WeatherEntityMapperInterface $entityMapper,
        DistanceService $distanceService
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityMapper = $entityMapper;
        $this->distanceService = $distanceService;
    }

    public function getWeatherDataByQuery(WeatherDataQuery $query): WeatherDto
    {
        $entities = $this->entityRepository->getLatestWeatherEntites();
        $dtos = [];
        foreach ($entities as $entity) {
            $dtos[] = $this->entityMapper->createDtoFromEntity($entity);
        }
         return $this->distanceService->getClosestWeerstation($dtos, $query->lat, $query->lon);
    }
}
