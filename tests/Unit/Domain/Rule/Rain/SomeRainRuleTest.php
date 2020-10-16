<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\Rain\SomeRainRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class SomeRainRuleTest extends TestCase
{
    private SomeRainRule $rule;

    public function setUp(): void
    {
        $this->rule = new SomeRainRule();
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutRating(): void
    {
        $rating = $this->rule->getRating();

        $this->assertEquals(Rating::beetjeKut(), $rating, 'Expected a some rain to return a beetje kut rating');
    }

    /**
     * @test
     */
    public function shouldMatchForAlotRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(15);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue($matched, 'Some rain rule should match for 15mm rain');
    }

    /**
     * @test
     */
    public function shouldMatchForALittleRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(5);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue($matched, 'Some rain rule should match for 5mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForNoRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(0);

        $matched = $this->rule->matches($currentWeather);

        $this->assertFalse($matched, 'Some rain rule should not match for 0mm rain');
    }

    private function getCurrentWeatherForRain(float $rain): CurrentWeather
    {
        return new CurrentWeather(10, $rain, 5, 90);
    }
}
