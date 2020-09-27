<?php

namespace App\Infrastructure\Entity;

use App\Application\Entity\WeatherEntityInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="App\Infrastructure\Repository\WeatherEntityRepository")
 * @Table("Weather")
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
class WeatherEntity implements WeatherEntityInterface
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="id")
     */
    public $identifier;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $region;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $stationName;

    /**
     * @var float
     * @Column(type="float")
     */
    public $lat;

    /**
     * @var float
     * @Column(type="float")
     */
    public $lon;

    /**
     * @var \DateTimeImmutable
     * @Column(type="datetime")
     */
    public $date;

    /**
     * @var float|null
     * @Column(type="float", nullable=true)
     */
    public $temperature;

    /**
     * @var float|null
     * @Column(type="float", nullable=true)
     */
    public $rain;

    /**
     * @var float|null
     * @Column(type="float", nullable=true)
     */
    public $windSpeed;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $windDirection;

    /**
     * @var int
     * @Column(type="integer")
     */
    public $temperatureRating;

    /**
     * @var int
     * @Column(type="integer")
     */
    public $rainRating;

    /**
     * @var int
     * @Column(type="integer")
     */
    public $windRating;

    /**
     * @var int
     * @Column(type="integer")
     */
    public $averageRating;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $background;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $summary;

    /**
     * @var \DateTimeImmutable
     * @Column(type="datetime")
     */
    public $day1Date;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day1Temp;

    /**
     * @var \DateTimeImmutable
     * @Column(type="datetime")
     */
    public $day2Date;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day2Temp;

    /**
     * @var \DateTimeImmutable
     * @Column(type="datetime")
     */
    public $day3Date;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day3Temp;

    /**
     * @var \DateTimeImmutable
     * @Column(type="datetime")
     */
    public $day4Date;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day4Temp;

    /**
     * @var \DateTimeImmutable
     * @Column(type="datetime")
     */
    public $day5Date;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day5Temp;

    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getStationName(): string
    {
        return $this->stationName;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
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

    public function getWindDirection(): string
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

    public function getBackground(): string
    {
        return $this->background;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getDay1Date(): \DateTimeImmutable
    {
        return $this->day1Date;
    }

    public function getDay1Temp(): float
    {
        return $this->day1Temp;
    }

    public function getDay2Date(): \DateTimeImmutable
    {
        return $this->day2Date;
    }

    public function getDay2Temp(): float
    {
        return $this->day2Temp;
    }

    public function getDay3Date(): \DateTimeImmutable
    {
        return $this->day3Date;
    }

    public function getDay3Temp(): float
    {
        return $this->day3Temp;
    }

    public function getDay4Date(): \DateTimeImmutable
    {
        return $this->day4Date;
    }

    public function getDay4Temp(): float
    {
        return $this->day4Temp;
    }

    public function getDay5Date(): \DateTimeImmutable
    {
        return $this->day5Date;
    }

    public function getDay5Temp(): float
    {
        return $this->day5Temp;
    }
}
