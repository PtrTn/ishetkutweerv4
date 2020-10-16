<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\Rain\TooMuchRainRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class TooMuchRainRuleTest extends TestCase
{
    private TooMuchRainRule $rule;

    public function setUp(): void
    {
        $this->rule = new TooMuchRainRule();
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutRating(): void
    {
        $rating = $this->rule->getRating();

        $this->assertEquals(Rating::megaKut(), $rating, 'Expected too much rain to return a mega kut rating');
    }

    /**
     * @test
     */
    public function shouldMatchForTooMuchRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(35);

        $matched = $this->rule->matches($currentWeather);

        $this->assertTrue($matched, 'Too much rain rule should match for 35mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForALittleRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(5);

        $matched = $this->rule->matches($currentWeather);

        $this->assertFalse($matched, 'Too much rain rule should not match for 5mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForNoRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(0);

        $matched = $this->rule->matches($currentWeather);

        $this->assertFalse($matched, 'Too much rain rule should not match for 0mm rain');
    }

    private function getCurrentWeatherForRain(float $rain): CurrentWeather
    {
        return new CurrentWeather(10, $rain, 5, 90);
    }
}
