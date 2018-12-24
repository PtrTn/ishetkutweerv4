<?php

namespace App\Tests\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\Rain\SomeRainRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class SomeRainRuleTest extends TestCase
{
    /**
     * @var SomeRainRule
     */
    private $rule;

    public function setUp()
    {
        $this->rule = new SomeRainRule();
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutRating()
    {
        $rating = $this->rule->getRating(new WeatherDto());

        $this->assertEquals(Rating::beetjeKut(), $rating, 'Expected a some rain to return a beetje kut rating');
    }

    /**
     * @test
     */
    public function shouldMatchForAlotRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 15.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue($matched, 'Some rain rule should match for 15mm rain');
    }

    /**
     * @test
     */
    public function shouldMatchForALittleRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 5.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue($matched, 'Some rain rule should match for 5mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForNoRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 0;

        $matched = $this->rule->matches($dto);

        $this->assertFalse($matched, 'Some rain rule should not match for 0mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForUnknownRain()
    {
        $dto = new WeatherDto();
        $dto->rain = NULL;

        $matched = $this->rule->matches($dto);

        $this->assertFalse($matched, 'Some rain rule should not match for an unknown amount rain');
    }
}
