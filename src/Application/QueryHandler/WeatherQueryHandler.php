<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Mapper\WeatherEntityMapperInterface;
use App\Application\Query\WeatherByLatLonQuery;
use App\Application\Query\WeatherByLocationQuery;
use App\Application\Repository\WeatherEntityRepositoryInterface;
use App\Application\Service\DistanceService;
use App\Domain\Dto\WeatherDto;
use InvalidArgumentException;

use function sprintf;

class WeatherQueryHandler
{
    private WeatherEntityRepositoryInterface $entityRepository;

    private WeatherEntityMapperInterface $entityMapper;

    private DistanceService $distanceService;

    public function __construct(
        WeatherEntityRepositoryInterface $entityRepository,
        WeatherEntityMapperInterface $entityMapper,
        DistanceService $distanceService
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityMapper = $entityMapper;
        $this->distanceService = $distanceService;
    }

    public function getWeatherDataByLatLonQuery(WeatherByLatLonQuery $query): WeatherDto
    {
        $entities = $this->entityRepository->getLatestEntites();
        $dtos = [];
        foreach ($entities as $entity) {
            $dtos[] = $this->entityMapper->createDtoFromEntity($entity);
        }

         return $this->distanceService->getClosestWeerstation($dtos, $query->lat, $query->lon);
    }

    public function getWeatherDataByLocationQuery(WeatherByLocationQuery $query): WeatherDto
    {
        $entities = $this->entityRepository->getLatestEntites();
        foreach ($entities as $entity) {
            if ($entity->getRegion() === $query->location) {
                return $this->entityMapper->createDtoFromEntity($entity);
            }
        }

        throw new InvalidArgumentException(sprintf('Unknown location "%s"', $query->location));
    }
}
