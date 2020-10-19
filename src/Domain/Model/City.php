<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class City
{
    private string $name;
    private float $lat;
    private float $lon;
    private int $postcodeNumbers;
    private string $postcodeCharacters;

    public function __construct(string $name, float $lat, float $lon, int $postcodeNumbers, string $postcodeCharacters)
    {
        $this->name = $name;
        $this->lat = $lat;
        $this->lon = $lon;
        $this->postcodeNumbers = $postcodeNumbers;
        $this->postcodeCharacters = $postcodeCharacters;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function getPostcodeNumbers(): int
    {
        return $this->postcodeNumbers;
    }

    public function getPostcodeCharacters(): string
    {
        return $this->postcodeCharacters;
    }
}
