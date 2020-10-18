<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Fixtures;

use App\Infrastructure\Entity\CityEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class VenloCityEntityFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entity = new CityEntity();
        $entity->cityName = 'Venlo';
        $entity->latitude = 51.50;
        $entity->longitude = 6.20;
        $entity->postcodeCharacters = 'AA';
        $entity->postcodeNumbers = 5911;

        $manager->persist($entity);

        $manager->flush();
    }
}
