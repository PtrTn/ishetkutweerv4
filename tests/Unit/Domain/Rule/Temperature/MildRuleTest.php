<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Rule\Temperature;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\Temperature\MildRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class MildRuleTest extends TestCase
{
    private MildRule $rule;

    public function setUp(): void
    {
        $this->rule = new MildRule();
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutRating(): void
    {
        $rating = $this->rule->getRating();

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Expected too hot or cold rule to return a beetje kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForMildTemperature(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(5);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue(
            $matched,
            'Mild rule should match for 5 degrees'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForHotTemperatures(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(30);

        $matched = $this->rule->matches($currentWeather);

        $this->assertFalse(
            $matched,
            'Mild rule should not match for 15 degrees'
        );
    }

    private function getCurrentWeatherForTemperature(float $temperature): CurrentWeather
    {
        return new CurrentWeather($temperature, 0, 5, 90);
    }
}
