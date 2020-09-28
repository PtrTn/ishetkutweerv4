<?php

namespace App\Tests\Unit\Application\Factory;

use App\Application\Dto\Buienradar\StationnaamDto;
use App\Application\Dto\Buienradar\VerwachtingMeerdaags;
use App\Application\Dto\Buienradar\VerwachtingVandaag;
use App\Application\Dto\Buienradar\WeerstationDto;
use App\Application\Factory\WeatherDtoFactory;
use App\Application\Factory\WeatherDtoSanitizer;
use DateTimeImmutable;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class WeatherDtoSanitizerTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function shouldSanitizeWeerstationDto()
    {
        $stationnaamDto = new StationnaamDto();
        $stationnaamDto->regio = 'Venlo';
        $stationnaamDto->stationnaam = 'Meetstation Arcen';

        $weerstationDto = new WeerstationDto();
        $weerstationDto->stationcode = '6391';
        $weerstationDto->stationnaam = $stationnaamDto;
        $weerstationDto->lat = '51.50';
        $weerstationDto->lon = '6.20';
        $weerstationDto->datum = new DateTimeImmutable();
        $weerstationDto->luchtvochtigheid = '73';
        $weerstationDto->temperatuurGC = '4.2';
        $weerstationDto->windsnelheidMS = '0.53';
        $weerstationDto->windsnelheidBF = '1';
        $weerstationDto->windrichtingGR = '112';
        $weerstationDto->windrichting = 'OZO';
        $weerstationDto->luchtdruk = '-';
        $weerstationDto->zichtmeters = '-';
        $weerstationDto->windstotenMS = '1.5';
        $weerstationDto->regenMMPU = '0.5';
        $weerstationDto->zonintensiteitWM2 = '58';
        $weerstationDto->icoonactueel = 'Vrijwel onbewolkt (zonnig/helder)';
        $weerstationDto->temperatuur10cm = '3.8';
        $weerstationDto->url = 'http://www.buienradar.nl/nederland/weerbericht/weergrafieken/6391';
        $weerstationDto->latGraden = '51.83';
        $weerstationDto->lonGraden = '6.33';

        $factory = Mockery::mock(WeatherDtoFactory::class);
        $factory
            ->shouldReceive('create')
            ->withArgs(function (
                VerwachtingVandaag $verwachtingVandaag,
                VerwachtingMeerdaags $verwachtingMeerdaags,
                WeerstationDto $sanitizedDto
            ) {
                $this->assertSame(6391, $sanitizedDto->stationcode);
                $this->assertSame(51.50, $sanitizedDto->lat);
                $this->assertSame(6.20, $sanitizedDto->lon);
                $this->assertSame(73, $sanitizedDto->luchtvochtigheid);
                $this->assertSame(4.2, $sanitizedDto->temperatuurGC);
                $this->assertSame(0.53, $sanitizedDto->windsnelheidMS);
                $this->assertSame(1.0, $sanitizedDto->windsnelheidBF);
                $this->assertSame(112, $sanitizedDto->windrichtingGR);
                $this->assertNull($sanitizedDto->luchtdruk);
                $this->assertNull($sanitizedDto->zichtmeters);
                $this->assertSame(1.5, $sanitizedDto->windstotenMS);
                $this->assertSame(0.5, $sanitizedDto->regenMMPU);
                $this->assertSame(58, $sanitizedDto->zonintensiteitWM2);
                $this->assertSame(3.8, $sanitizedDto->temperatuur10cm);
                $this->assertSame(51.83, $sanitizedDto->latGraden);
                $this->assertSame(6.33, $sanitizedDto->lonGraden);
                
                return true;
            })
            ->once();

        $sanitizer = new WeatherDtoSanitizer($factory);
        $sanitizer->create(
            new VerwachtingVandaag(),
            new VerwachtingMeerdaags(),
            $weerstationDto
        );
    }
}
