<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="App\Infrastructure\Repository\WeatherEntityRepository")
 * @Table("Weather")
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class WeatherEntity
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
     * @var string
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
}
