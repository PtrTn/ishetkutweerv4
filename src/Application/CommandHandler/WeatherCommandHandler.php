<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\ApiClient\BuienradarApiClientInterface;
use App\Application\Assembler\WeatherDtoAssemblerInterface;
use App\Application\Factory\WeatherDtoFactoryInterface;
use App\Application\Mapper\WeatherEntityMapperInterface;
use App\Application\Repository\WeatherEntityRepositoryInterface;

class WeatherCommandHandler
{
    private BuienradarApiClientInterface $apiClient;

    private WeatherDtoFactoryInterface $dtoFactory;

    private WeatherDtoAssemblerInterface $assembler;

    private WeatherEntityMapperInterface $entityFactory;

    private WeatherEntityRepositoryInterface $entityRepository;

    public function __construct(
        BuienradarApiClientInterface $apiClient,
        WeatherDtoFactoryInterface $dtoFactory,
        WeatherDtoAssemblerInterface $assembler,
        WeatherEntityMapperInterface $entityFactory,
        WeatherEntityRepositoryInterface $entityRepository
    ) {
        $this->apiClient = $apiClient;
        $this->dtoFactory = $dtoFactory;
        $this->assembler = $assembler;
        $this->entityFactory = $entityFactory;
        $this->entityRepository = $entityRepository;
    }

    public function storeWeatherData(): void
    {
        $data = $this->apiClient->getData();

        $entities = [];
        foreach ($data->weergegevens->actueel_weer->weerstations as $weerstationDto) {
            $dto = $this->dtoFactory->create(
                $data->weergegevens->verwachting_vandaag,
                $data->weergegevens->verwachting_meerdaags,
                $weerstationDto
            );
            $dto = $this->assembler->assemble($dto);
            $entities[] = $this->entityFactory->createEntityFromDto($dto);
        }

        $this->entityRepository->saveEntities($entities);
    }
}
