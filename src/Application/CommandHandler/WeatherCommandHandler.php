<?php

namespace App\Application\CommandHandler;

use App\Application\ApiClient\BuienradarApiClientInterface;
use App\Application\Assembler\WeatherDtoAssemblerInterface;
use App\Application\Factory\WeatherDtoFactoryInterface;
use App\Application\Factory\WeatherEntityFactoryInterface;
use App\Application\Repository\WeatherEntityRepositoryInterface;

class WeatherCommandHandler
{
    /**
     * @var BuienradarApiClientInterface
     */
    private $apiClient;

    /**
     * @var WeatherDtoFactoryInterface
     */
    private $dtoFactory;

    /**
     * @var WeatherDtoAssemblerInterface
     */
    private $assembler;

    /**
     * @var WeatherEntityFactoryInterface
     */
    private $entityFactory;

    /**
     * @var WeatherEntityRepositoryInterface
     */
    private $entityRepository;

    public function __construct(
        BuienradarApiClientInterface $apiClient,
        WeatherDtoFactoryInterface $dtoFactory,
        WeatherDtoAssemblerInterface $assembler,
        WeatherEntityFactoryInterface $entityFactory,
        WeatherEntityRepositoryInterface $entityRepository
    ) {
        $this->apiClient = $apiClient;
        $this->dtoFactory = $dtoFactory;
        $this->assembler = $assembler;
        $this->entityFactory = $entityFactory;
        $this->entityRepository = $entityRepository;
    }

    public function storeWeatherData()
    {
        $dtos = $this->getWeatherData();
        $entities = [];
        foreach ($dtos as $dto) {
            $entities[] = $this->entityFactory->createFromWeatherDto($dto);
        }
        $this->entityRepository->saveEntities($entities);
    }

    private function getWeatherData()
    {
        $data = $this->apiClient->getData();
        $dtos = [];
        foreach ($data->weergegevens->actueel_weer->weerstations as $weerstationDto) {
            $dto = $this->dtoFactory->createFromWeerstationDto($weerstationDto);
            $dtos[] = $this->assembler->assemble($dto);
        }
        return $dtos;
    }
}
