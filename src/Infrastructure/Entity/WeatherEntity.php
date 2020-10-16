<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="App\Infrastructure\Repository\WeatherEntityRepository")
 * @Table("weather")
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
class WeatherEntity
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="id")
     */
    public ?int $identifier;

    /** @Column(type="string", length=255) */
    public string $location;

    /** @Column(type="float", nullable=true) */
    public ?float $lat;

    /** @Column(type="float", nullable=true) */
    public ?float $lon;

    /** @Column(type="datetime_immutable") */
    public DateTimeImmutable $dateTime;

    /** @Column(type="float", nullable=true) */
    public ?float $temperature = null;

    /** @Column(type="float", nullable=true) */
    public ?float $rain = null;

    /** @Column(type="float", nullable=true) */
    public ?float $windSpeed = null;

    /** @Column(type="integer", nullable=true) */
    public ?int $windDirection;

    /** @Column(type="integer") */
    public int $temperatureRating;

    /** @Column(type="integer") */
    public int $rainRating;

    /** @Column(type="integer") */
    public int $windRating;

    /** @Column(type="integer") */
    public int $averageRating;

    /** @Column(type="string", length=255) */
    public string $description;

    /** @Column(type="datetime_immutable") */
    public DateTimeImmutable $day1Date;

    /** @Column(type="float") */
    public float $day1Temp;

    /** @Column(type="datetime_immutable") */
    public DateTimeImmutable $day2Date;

    /** @Column(type="float") */
    public float $day2Temp;

    /** @Column(type="datetime_immutable") */
    public DateTimeImmutable $day3Date;

    /** @Column(type="float") */
    public float $day3Temp;

    /** @Column(type="datetime_immutable") */
    public DateTimeImmutable $day4Date;

    /** @Column(type="float") */
    public float $day4Temp;

    /** @Column(type="datetime_immutable") */
    public DateTimeImmutable $day5Date;

    /** @Column(type="float") */
    public float $day5Temp;

    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function getDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function getRain(): ?float
    {
        return $this->rain;
    }

    public function getWindSpeed(): ?float
    {
        return $this->windSpeed;
    }

    public function getWindDirection(): ?int
    {
        return $this->windDirection;
    }

    public function getTemperatureRating(): int
    {
        return $this->temperatureRating;
    }

    public function getRainRating(): int
    {
        return $this->rainRating;
    }

    public function getWindRating(): int
    {
        return $this->windRating;
    }

    public function getAverageRating(): int
    {
        return $this->averageRating;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDay1Date(): DateTimeImmutable
    {
        return $this->day1Date;
    }

    public function getDay1Temp(): float
    {
        return $this->day1Temp;
    }

    public function getDay2Date(): DateTimeImmutable
    {
        return $this->day2Date;
    }

    public function getDay2Temp(): float
    {
        return $this->day2Temp;
    }

    public function getDay3Date(): DateTimeImmutable
    {
        return $this->day3Date;
    }

    public function getDay3Temp(): float
    {
        return $this->day3Temp;
    }

    public function getDay4Date(): DateTimeImmutable
    {
        return $this->day4Date;
    }

    public function getDay4Temp(): float
    {
        return $this->day4Temp;
    }

    public function getDay5Date(): DateTimeImmutable
    {
        return $this->day5Date;
    }

    public function getDay5Temp(): float
    {
        return $this->day5Temp;
    }
}
