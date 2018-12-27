<?php

namespace App\Tests\Unit\Application\CommandHandler;

use App\Application\ApiClient\BuienradarApiClientInterface;
use App\Application\Assembler\WeatherDtoAssemblerInterface;
use App\Application\CommandHandler\WeatherCommandHandler;
use App\Application\Dto\Buienradar\BuienradarnlDto;
use App\Application\Dto\Buienradar\WeergegevensDto;
use App\Application\Dto\Buienradar\WeerstationDto;
use App\Application\Dto\Buienradar\WeerstationsDto;
use App\Application\Factory\WeatherDtoFactoryInterface;
use App\Application\Mapper\WeatherEntityMapperInterface;
use App\Application\Repository\WeatherEntityRepositoryInterface;
use App\Domain\Dto\WeatherDto;
use App\Infrastructure\Entity\WeatherEntity;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class WeatherCommandHandlerTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function shouldStoreWeatherData()
    {
        $actueelWeer = new WeerstationsDto();
        $actueelWeer->weerstations = [new WeerstationDto()];
        $weergegevensDto = new WeergegevensDto();
        $weergegevensDto->actueel_weer = $actueelWeer;
        $buienradarNlDto = new BuienradarnlDto();
        $buienradarNlDto->weergegevens = $weergegevensDto;

        $apiClient = Mockery::mock(BuienradarApiClientInterface::class);
        $apiClient
            ->shouldReceive('getData')
            ->andReturn($buienradarNlDto)
            ->once();

        $dtoFactory = Mockery::mock(WeatherDtoFactoryInterface::class);
        $dtoFactory
            ->shouldReceive('createFromWeerstationDto')
            ->andReturn(new WeatherDto())
            ->once();

        $assembler = Mockery::mock(WeatherDtoAssemblerInterface::class);
        $assembler
            ->shouldReceive('assemble')
            ->andReturn(new WeatherDto())
            ->once();

        $entityFactory = Mockery::mock(WeatherEntityMapperInterface::class);
        $entityFactory
            ->shouldReceive('createEntityFromDto')
            ->andReturn(new WeatherEntity())
            ->once();

        $entityRepository = Mockery::mock(WeatherEntityRepositoryInterface::class);
        $entityRepository
            ->shouldReceive('saveEntities')
            ->once();

        $commandHandler = new WeatherCommandHandler(
            $apiClient,
            $dtoFactory,
            $assembler,
            $entityFactory,
            $entityRepository
        );

        $commandHandler->storeWeatherData();
    }

}
