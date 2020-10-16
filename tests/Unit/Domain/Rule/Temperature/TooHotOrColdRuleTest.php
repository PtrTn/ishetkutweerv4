<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Rule\Temperature;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\Temperature\TooHotOrColdRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class TooHotOrColdRuleTest extends TestCase
{
    private TooHotOrColdRule $rule;

    public function setUp(): void
    {
        $this->rule = new TooHotOrColdRule();
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutRating(): void
    {
        $rating = $this->rule->getRating();

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Expected too hot or cold rule to return a mega kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForHotTemperature(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(40);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue(
            $matched,
            'Too hot or cold rule should match for 40 degrees'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForColdTemperature(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(-15);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue(
            $matched,
            'Too hot or cold rule should match for minus 15 degrees'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForMildTemperatures(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(15);

        $matched = $this->rule->matches($currentWeather);

        $this->assertFalse(
            $matched,
            'Too hot or cold rule should not match for 15 degrees'
        );
    }

    private function getCurrentWeatherForTemperature(float $temperature): CurrentWeather
    {
        return new CurrentWeather($temperature, 0, 5, 90);
    }
}
