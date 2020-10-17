<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="App\Infrastructure\Repository\CityEntityRepository")
 * @Table("cities")
 */
class CityEntity
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="id")
     */
    public ?int $identifier;

    /** @Column(type="string", length=255) */
    public string $cityName;

    /** @Column(type="integer") */
    public int $postcodeNumbers;

    /** @Column(type="string", length=2) */
    public string $postcodeCharacters;

    /** @Column(type="float") */
    public float $latitude;

    /** @Column(type="float") */
    public float $longitude;
}
