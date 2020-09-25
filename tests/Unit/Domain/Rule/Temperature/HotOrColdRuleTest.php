<?php

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\Temperature\HotOrColdRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class HotOrColdRuleTest extends TestCase
{
    /**
     * @var HotOrColdRule
     */
    private $rule;

    public function setUp(): void
    {
        $this->rule = new HotOrColdRule();
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
            'Expected hot or cold rule to return a kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForHotTemperature()
    {
        $dto = new WeatherDto();
        $dto->temperature = 35.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue(
            $matched,
            'Hot or cold rule should match for 35 degrees'
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
            'Hot or cold rule should match for minus 15 degrees'
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
            'Hot or cold rule should not match for 15 degrees'
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
            'Hot or cold rule should not match for an unknown temperatures'
        );
    }
}
