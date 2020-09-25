<?php

namespace App\Tests\Unit\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\Rain\TooMuchRainRule;
use App\Domain\ValueObject\Rating;
use PHPUnit\Framework\TestCase;

class TooMuchRainRuleTest extends TestCase
{
    /**
     * @var TooMuchRainRule
     */
    private $rule;

    public function setUp(): void
    {
        $this->rule = new TooMuchRainRule();
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutRating()
    {
        $rating = $this->rule->getRating(new WeatherDto());

        $this->assertEquals(Rating::megaKut(), $rating, 'Expected too much rain to return a mega kut rating');
    }

    /**
     * @test
     */
    public function shouldMatchForTooMuchRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 35.0;

        $matched = $this->rule->matches($dto);

        $this->assertTrue($matched, 'Too much rain rule should match for 35mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForALittleRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 5.0;

        $matched = $this->rule->matches($dto);

        $this->assertFalse($matched, 'Too much rain rule should not match for 5mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForNoRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 0;

        $matched = $this->rule->matches($dto);

        $this->assertFalse($matched, 'Too much rain rule should not match for 0mm rain');
    }

    /**
     * @test
     */
    public function shouldNotMatchForUnknownRain()
    {
        $dto = new WeatherDto();
        $dto->rain = NULL;

        $matched = $this->rule->matches($dto);

        $this->assertFalse($matched, 'Too much rain rule should not match for an unknown amount rain');
    }
}
