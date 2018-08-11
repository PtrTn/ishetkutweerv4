<?php

namespace App\Domain\ValueObject;

class Rating
{
    /**
     * @var int
     */
    private $rating;

    private function __construct(int $rating)
    {
        $this->rating = $rating;
    }

    public static function megaKut(): self
    {
        return new self(4);
    }

    public static function kut(): self
    {
        return new self(3);
    }

    public static function beetjeKut(): self
    {
        return new self(2);
    }

    public static function nietKut(): self
    {
        return new self(1);
    }

    public function getRating(): int {
        return $this->rating;
    }
}
