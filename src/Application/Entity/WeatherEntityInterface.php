<?php

declare(strict_types=1);

namespace App\Application\Entity;

use DateTimeImmutable;

interface WeatherEntityInterface
{

    public function getIdentifier(): int;

    public function getRegion(): string;

    public function getStationName(): string;

    public function getLat(): string;

    public function getLon(): float;

    public function getDate(): DateTimeImmutable;

    public function getTemperature(): ?float;

    public function getRain(): ?float;

    public function getWindSpeed(): ?float;

    public function getWindDirection(): string;

    public function getTemperatureRating(): int;

    public function getRainRating(): int;

    public function getWindRating(): int;

    public function getAverageRating(): int;

    public function getBackground(): string;

    public function getSummary(): string;

    public function getDay1Date(): DateTimeImmutable;

    public function getDay1Temp(): float;

    public function getDay2Date(): DateTimeImmutable;

    public function getDay2Temp(): float;

    public function getDay3Date(): DateTimeImmutable;

    public function getDay3Temp(): float;

    public function getDay4Date(): DateTimeImmutable;

    public function getDay4Temp(): float;

    public function getDay5Date(): DateTimeImmutable;

    public function getDay5Temp(): float;
}
