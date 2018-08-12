<?php

namespace App\Infrastructure\Repository;

use App\Application\Repository\WeatherEntityRepositoryInterface;
use App\Infrastructure\Entity\WeatherEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WeatherEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherEntity[]    findAll()
 * @method WeatherEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherEntityRepository extends ServiceEntityRepository implements WeatherEntityRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WeatherEntity::class);
    }

    public function saveEntities(array $entities): void
    {
        $entityManager = $this->getEntityManager();
        foreach ($entities as $entity) {
            $entityManager->persist($entity);
        }
        $entityManager->flush();
    }

    /**
     * @return WeatherEntity[]
     */
    public function getLatestWeatherEntites(): array
    {
        $qb = $this->createQueryBuilder('w1');
        $qb
            ->select('w1')
            ->leftJoin(WeatherEntity::class, 'w2', Join::WITH, 'w1.location = w2.location AND w1.date < w2.date')
            ->where('w2.location IS NULL')
            ->orderBy('w1.date', 'DESC')
            ->orderBy('w1.location');
        return $qb->getQuery()->execute();
    }
}
