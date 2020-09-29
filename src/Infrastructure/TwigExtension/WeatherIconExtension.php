<?php

declare(strict_types=1);

namespace App\Infrastructure\TwigExtension;

use App\Domain\Dto\WeatherDto;
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
            new TwigFilter('weatherIcon', [$this, 'getIconForWeatherDto']),
            new TwigFilter('windIcon', [$this, 'getWindIconForWeatherDto']),
        ];
    }

    public function getIconForWeatherDto(WeatherDto $dto): string
    {
        if ($dto->hasSnow()) {
            return self::SNOW;
        }

        if ($dto->hasRain()) {
            return self::RAIN;
        }

        if ($dto->hasShowers()) {
            return self::SHOWERS;
        }

        if ($dto->hasWind()) {
            return self::WIND;
        }

        if ($dto->hasBreeze()) {
            return self::BREEZE;
        }

        return self::SUN;
    }

    public function getWindIconForWeatherDto(WeatherDto $dto): string
    {
        if ($dto->windSpeed === null) {
            return '';
        }

        if ($dto->windSpeed > 0 && $dto->windSpeed <= 12) {
            return sprintf('wi-wind-beaufort-%s', $dto->windSpeed);
        }

        return self::UNKNOWN;
    }
}
