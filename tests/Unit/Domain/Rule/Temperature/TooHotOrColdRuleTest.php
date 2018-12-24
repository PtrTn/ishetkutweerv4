<?php

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\Temperature\TooHotOrColdRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class TooHotOrColdRuleTest extends TestCase
{
    /**
     * @var TooHotOrColdRule
     */
    private $rule;

    public function setUp()
    {
        $this->rule = new TooHotOrColdRule();
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutRating()
    {
        $rating = $this->rule->getRating(new WeatherDto());

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Expected too hot or cold rule to return a mega kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForHotTemperature()
    {
        $dto = new WeatherDto();
        $dto->temperature = 40.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue(
            $matched,
            'Too hot or cold rule should match for 40 degrees'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForColdTemperature()
    {
        $dto = new WeatherDto();
        $dto->temperature = -15.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue(
            $matched,
            'Too hot or cold rule should match for minus 15 degrees'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForMildTemperatures()
    {
        $dto = new WeatherDto();
        $dto->temperature = 15.0;

        $matched = $this->rule->matches($dto);

        $this->assertFalse(
            $matched,
            'Too hot or cold rule should not match for 15 degrees'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForUnknownTemperatures()
    {
        $dto = new WeatherDto();
        $dto->temperature = NULL;

        $matched = $this->rule->matches($dto);

        $this->assertFalse(
            $matched,
            'Too hot or cold rule should not match for an unknown temperatures'
        );
    }
}
