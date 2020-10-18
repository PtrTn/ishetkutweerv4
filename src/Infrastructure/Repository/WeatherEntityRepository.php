<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\WeatherEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

use function array_map;

/**
 * @method WeatherEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherEntity[]    findAll()
 * @method WeatherEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherEntityRepository extends ServiceEntityRepository implements WeatherEntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherEntity::class);
    }

    /** @param  WeatherEntity[] $entities */
    public function saveEntities(array $entities): void
    {
        $entityManager = $this->getEntityManager();
        foreach ($entities as $entity) {
            $entityManager->persist($entity);
        }

        $entityManager->flush();
    }

    /** @param  WeatherEntity[] $entities */
    public function deleteEntities(array $entities): void
    {
        $entityManager = $this->getEntityManager();
        foreach ($entities as $entity) {
            $entityManager->remove($entity);
        }

        $entityManager->flush();
    }

    /** @return WeatherEntity[] */
    public function getLatestEntites(): array
    {
        $queryBuilder = $this->createQueryBuilder('w1');

        return $queryBuilder
            ->select('w1')
            ->leftJoin(WeatherEntity::class, 'w2', Join::WITH, 'w1.location = w2.location AND w1.dateTime < w2.dateTime')
            ->where('w2.location IS NULL')
            ->orderBy('w1.dateTime', 'DESC')
            ->orderBy('w1.location')
            ->groupBy('w1.location')
            ->getQuery()
            ->getResult();
    }

    /** @return WeatherEntity[] */
    public function getOutdatedEntities(): array
    {
        $latestEntities = $this->getLatestEntites();
        $entityIds = array_map(static function (WeatherEntity $entity) {
            return $entity->getIdentifier();
        }, $latestEntities);

        $queryBuilder = $this->createQueryBuilder('w');

        return $queryBuilder
            ->select('w')
            ->where($queryBuilder->expr()->notIn('w.identifier', $entityIds))
            ->getQuery()
            ->getResult();
    }
}
