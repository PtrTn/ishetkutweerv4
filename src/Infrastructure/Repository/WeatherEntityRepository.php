<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\WeatherEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WeatherEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherEntity[]    findAll()
 * @method WeatherEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WeatherEntity::class);
    }
}
