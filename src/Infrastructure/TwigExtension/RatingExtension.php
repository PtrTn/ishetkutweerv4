<?php

namespace App\Infrastructure\TwigExtension;

use App\Domain\Dto\WeatherRatingDto;
use App\Domain\ValueObject\Rating;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RatingExtension extends AbstractExtension
{
    private const NIET_KUT = 'Het is geen kutweer';

    private const BEETJE_KUT = 'Het is een beetje kutweer';

    private const KUT = 'Het is kutweer';

    private const MEGA_KUT = 'Het is mega kutweer';

    public function getFilters()
    {
        return [
            new TwigFilter('formatRating', [$this, 'formatRating']),
        ];
    }

    public function formatRating(WeatherRatingDto $ratingDto)
    {
        if ($ratingDto->averageRating->getRating() <= Rating::NIET_KUT) {
            return self::NIET_KUT;
        }
        if ($ratingDto->averageRating->getRating() <= Rating::BEETJE_KUT) {
            return self::BEETJE_KUT;
        }
        if ($ratingDto->averageRating->getRating() <= Rating::KUT) {
            return self::KUT;
        }

        return self::MEGA_KUT;
    }
}
