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
    public $location;

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
}
