<?php

declare(strict_types=1);

namespace App\Infrastructure\TwigExtension;

use App\Domain\Model\WeatherRating;
use App\Domain\ValueObject\Rating;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RatingExtension extends AbstractExtension
{
    private const NIET_KUT = 'Het is geen kutweer';

    private const BEETJE_KUT = 'Het is een beetje kutweer';

    private const KUT = 'Het is kutweer';

    private const MEGA_KUT = 'Het is mega kutweer';

    /** @return TwigFilter[] */
    public function getFilters(): array
    {
        return [
            new TwigFilter('formatRating', [$this, 'formatRating']),
        ];
    }

    public function formatRating(WeatherRating $weatherRating): string
    {
        if ($weatherRating->getAverageRating()->getRating() <= Rating::NIET_KUT) {
            return self::NIET_KUT;
        }

        if ($weatherRating->getAverageRating()->getRating() <= Rating::BEETJE_KUT) {
            return self::BEETJE_KUT;
        }

        if ($weatherRating->getAverageRating()->getRating() <= Rating::KUT) {
            return self::KUT;
        }

        return self::MEGA_KUT;
    }
}
