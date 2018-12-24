<?php

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\Rain\AlotRainRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class AlotRainRuleTest extends TestCase
{
    /**
     * @var AlotRainRule
     */
    private $rule;

    public function setUp()
    {
        $this->rule = new AlotRainRule();
    }

    /**
     * @test
     */
    public function shouldReturnKutRating()
    {
        $rating = $this->rule->getRating(new WeatherDto());

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'Expected a lot of rain to return a kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForAlotRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 15.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue(
            $matched,
            'Alot of rain rule should match for 15mm rain'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForALittleRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 5.0;

        $matched = $this->rule->matches($dto);

        $this->assertFalse(
            $matched,
            'Alot of rain rule should not match for 5mm rain'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForNoRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 0;

        $matched = $this->rule->matches($dto);

        $this->assertFalse(
            $matched,
            'Alot of rain rule should not match for 0mm rain'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForUnknownRain()
    {
        $dto = new WeatherDto();
        $dto->rain = null;

        $matched = $this->rule->matches($dto);

        $this->assertFalse(
            $matched,
            'Alot of rain rule should not match for an unknown amount rain'
        );
    }
}
