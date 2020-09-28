<?php

namespace App\Tests\Integration\Application\Assembler;

use App\Application\Assembler\WeatherDtoAssemblerInterface;
use App\Application\Assembler\WeatherDtoAssemblerManager;
use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WeatherDtoAssemblerManagerTest extends KernelTestCase
{
    /**
     * @var WeatherDtoAssemblerManager
     */
    private $assembler;

    public function setUp(): void
    {
        self::bootKernel();
        $this->assembler = self::$container->get(WeatherDtoAssemblerInterface::class);
    }

    /**
     * @test
     */
    public function shouldAssemble()
    {
        $dto = new WeatherDto();

        $assembledDto = $this->assembler->assemble($dto);

        $this->assertEquals('rain.jpg', $assembledDto->background);
        $this->assertInstanceOf(WeatherRatingDto::class, $assembledDto->rating);
    }
}
