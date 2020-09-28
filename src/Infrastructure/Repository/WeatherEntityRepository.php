<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Entity\WeatherEntityInterface;
use App\Application\Repository\WeatherEntityRepositoryInterface;
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

    /** @param WeatherEntityInterface[] $entities */
    public function saveEntities(array $entities): void
    {
        $entityManager = $this->getEntityManager();
        foreach ($entities as $entity) {
            $entityManager->persist($entity);
        }

        $entityManager->flush();
    }

    /** @param WeatherEntityInterface[] $entities */
    public function deleteEntities(array $entities): void
    {
        $entityManager = $this->getEntityManager();
        foreach ($entities as $entity) {
            $entityManager->remove($entity);
        }

        $entityManager->flush();
    }

    /** @return WeatherEntityInterface[] */
    public function getLatestEntites(): array
    {
        $queryBuilder = $this->createQueryBuilder('w1');

        return $queryBuilder
            ->select('w1')
            ->leftJoin(WeatherEntity::class, 'w2', Join::WITH, 'w1.region = w2.region AND w1.date < w2.date')
            ->where('w2.region IS NULL')
            ->orderBy('w1.date', 'DESC')
            ->orderBy('w1.region')
            ->groupBy('w1.region')
            ->getQuery()
            ->getResult();
    }

    /** @return WeatherEntityInterface[] */
    public function getOutdatedEntities(): array
    {
        $latestEntities = $this->getLatestEntites();
        $entityIds = array_map(static function (WeatherEntity $entity) {
            return $entity->identifier;
        }, $latestEntities);

        $queryBuilder = $this->createQueryBuilder('w');

        return $queryBuilder
            ->select('w')
            ->where($queryBuilder->expr()->notIn('w.id', $entityIds))
            ->getQuery()
            ->getResult();
    }
}
