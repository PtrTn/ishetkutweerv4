<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Rule\Temperature;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\Temperature\HotOrColdRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class HotOrColdRuleTest extends TestCase
{
    private HotOrColdRule $rule;

    public function setUp(): void
    {
        $this->rule = new HotOrColdRule();
    }

    /**
     * @test
     */
    public function shouldReturnKutRating(): void
    {
        $rating = $this->rule->getRating();

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'Expected hot or cold rule to return a kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForHotTemperature(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(35);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue(
            $matched,
            'Hot or cold rule should match for 35 degrees'
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
            'Hot or cold rule should match for minus 15 degrees'
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
            'Hot or cold rule should not match for 15 degrees'
        );
    }

    private function getCurrentWeatherForTemperature(float $temperature): CurrentWeather
    {
        return new CurrentWeather($temperature, 0, 5, 90);
    }
}
