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
 */
class WeatherEntity
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    public $id;

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
     * @var string
     * @Column(type="string", length=255)
     */
    public $day1Day;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day1Temp;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $day2Day;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day2Temp;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $day3Day;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day3Temp;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $day4Day;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day4Temp;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    public $day5Day;

    /**
     * @var float
     * @Column(type="float")
     */
    public $day5Temp;
}
