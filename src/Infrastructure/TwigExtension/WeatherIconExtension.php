<?php

declare(strict_types=1);

namespace App\Infrastructure\TwigExtension;

use App\Domain\Model\CurrentWeather;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

use function sprintf;

class WeatherIconExtension extends AbstractExtension
{
    private const SUN = 'wi-day-sunny';

    private const RAIN = 'wi-day-rain';

    private const SHOWERS = 'wi-day-showers';

    private const SNOW = 'wi-day-snow';

    private const BREEZE = 'wi-day-light-wind';

    private const WIND = 'wi-day-windy';

    private const UNKNOWN = 'wi-na';

    /** @return TwigFilter[] */
    public function getFilters(): array
    {
        return [
            new TwigFilter('weatherIcon', [$this, 'getIconForCurrentWeather']),
            new TwigFilter('windIcon', [$this, 'getWindIconForCurrentWeather']),
        ];
    }

    public function getIconForCurrentWeather(CurrentWeather $currentWeather): string
    {
        if ($currentWeather->hasSnow()) {
            return self::SNOW;
        }

        if ($currentWeather->hasRain()) {
            return self::RAIN;
        }

        if ($currentWeather->hasShowers()) {
            return self::SHOWERS;
        }

        if ($currentWeather->hasWind()) {
            return self::WIND;
        }

        if ($currentWeather->hasBreeze()) {
            return self::BREEZE;
        }

        return self::SUN;
    }

    public function getWindIconForCurrentWeather(CurrentWeather $currentWeather): string
    {
        if ($currentWeather->getWindSpeed() > 0 && $currentWeather->getWindSpeed() <= 12) {
            return sprintf('wi-wind-beaufort-%s', $currentWeather->getWindSpeed());
        }

        return self::UNKNOWN;
    }
}
