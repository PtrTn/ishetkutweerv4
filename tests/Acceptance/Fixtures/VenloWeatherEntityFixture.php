<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Fixtures;

use App\Infrastructure\Entity\WeatherEntity;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class VenloWeatherEntityFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entity = new WeatherEntity();
        $entity->identifier = 123;
        $entity->location = 'Venlo';
        $entity->lat = 51.50;
        $entity->lon = 6.20;
        $entity->dateTime = new DateTimeImmutable();
        $entity->temperature = 3.8;
        $entity->rain = 0.5;
        $entity->windSpeed = 1.1;
        $entity->windDirection = 270;
        $entity->temperatureRating = 3;
        $entity->rainRating = 3;
        $entity->windRating = 3;
        $entity->averageRating = 3;
        $entity->description = 'All is good';
        $entity->day1Date = new DateTimeImmutable('+1 day');
        $entity->day1Temp = 12;
        $entity->day2Date = new DateTimeImmutable('+2 days');
        $entity->day2Temp = 12;
        $entity->day3Date = new DateTimeImmutable('+3 days');
        $entity->day3Temp = 12;
        $entity->day4Date = new DateTimeImmutable('+4 days');
        $entity->day4Temp = 12;
        $entity->day5Date = new DateTimeImmutable('+5 days');
        $entity->day5Temp = 12;

        $manager->persist($entity);

        $manager->flush();
    }
}
