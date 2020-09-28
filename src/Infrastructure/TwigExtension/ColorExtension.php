<?php

declare(strict_types=1);

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

    /** @return TwigFilter[] */
    public function getFilters(): array
    {
        return [
            new TwigFilter('backgroundColor', [$this, 'getBackgroundColorForRatingDto']),
        ];
    }

    public function getBackgroundColorForRatingDto(WeatherRatingDto $ratingDto): string
    {
        if ($ratingDto->averageRating->getRating() <= Rating::NIET_KUT) {
            return self::GOOD;
        }

        if ($ratingDto->averageRating->getRating() <= Rating::BEETJE_KUT) {
            return self::MEDIUM;
        }

        if ($ratingDto->averageRating->getRating() <= Rating::KUT) {
            return self::BAD;
        }

        return self::WORST;
    }
}
