<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\Rain\AlotRainRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class AlotRainRuleTest extends TestCase
{
    private AlotRainRule $rule;

    public function setUp(): void
    {
        $this->rule = new AlotRainRule();
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
            'Expected a lot of rain to return a kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldMatchForAlotRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(15);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue(
            $matched,
            'Alot of rain rule should match for 15mm rain'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForALittleRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(5);

        $matched = $this->rule->matches($currentWeather);

        $this->assertFalse(
            $matched,
            'Alot of rain rule should not match for 5mm rain'
        );
    }

    /**
     * @test
     */
    public function shouldNotMatchForNoRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(0);

        $matched = $this->rule->matches($currentWeather);

        $this->assertFalse(
            $matched,
            'Alot of rain rule should not match for 0mm rain'
        );
    }

    private function getCurrentWeatherForRain(float $rain): CurrentWeather
    {
        return new CurrentWeather(10, $rain, 5, 90);
    }
}
