<?php

namespace App\Infrastructure\TwigExtension;

use App\Domain\Dto\WeatherRatingDto;
use App\Domain\ValueObject\Rating;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ColorExtension extends AbstractExtension
{
    private const GOOD = 'bg-success';

    private const MEDIUM = 'bg-primary';

    private const BAD = 'bg-warning';

    private const WORST = 'bg-danger';

    public function getFilters()
    {
        return [
            new TwigFilter('backgroundColor', [$this, 'getBackgroundColorForRatingDto']),
        ];
    }

    public function getBackgroundColorForRatingDto(WeatherRatingDto $ratingDto)
    {
        if ($ratingDto->averageRating <= Rating::NIET_KUT) {
            return self::GOOD;
        }
        if ($ratingDto->averageRating <= Rating::BEETJE_KUT) {
            return self::MEDIUM;
        }
        if ($ratingDto->averageRating <= Rating::KUT) {
            return self::BAD;
        }

        return self::WORST;
    }
}
