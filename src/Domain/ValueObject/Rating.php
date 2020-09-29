<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class Rating
{
    public const MEGA_KUT = 4;

    public const KUT = 3;

    public const BEETJE_KUT = 2;

    public const NIET_KUT = 1;

    private int $rating;

    public function __construct(int $rating)
    {
        $this->rating = $rating;
    }

    public static function megaKut(): self
    {
        return new self(self::MEGA_KUT);
    }

    public static function kut(): self
    {
        return new self(self::KUT);
    }

    public static function beetjeKut(): self
    {
        return new self(self::BEETJE_KUT);
    }

    public static function nietKut(): self
    {
        return new self(self::NIET_KUT);
    }

    public function getRating(): int
    {
        return $this->rating;
    }
}
