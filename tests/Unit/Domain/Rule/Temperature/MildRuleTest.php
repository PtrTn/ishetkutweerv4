<?php

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\Temperature\MildRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class MildRuleTest extends TestCase
{
    /**
     * @var MildRule
     */
    private $rule;

    public function setUp(): void
    {
        $this->rule = new MildRule();
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutRating()
    {
        $rating = $this->rule->getRating(new WeatherDto());

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Expected too hot or cold rule to return a beetje kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForMildTemperature()
    {
        $dto = new WeatherDto();
        $dto->temperature = 5.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue(
            $matched,
            'Mild rule should match for 5 degrees'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForHotTemperatures()
    {
        $dto = new WeatherDto();
        $dto->temperature = 30.0;

        $matched = $this->rule->matches($dto);

        $this->assertFalse(
            $matched,
            'Mild rule should not match for 15 degrees'
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
            'Mild rule should not match for an unknown temperatures'
        );
    }
}
