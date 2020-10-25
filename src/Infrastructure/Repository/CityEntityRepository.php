<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\CityEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Generator;
use RuntimeException;

/**
 * @method CityEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CityEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CityEntity[]    findAll()
 * @method CityEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityEntityRepository extends ServiceEntityRepository
{
    private const BULK_SIZE = 5000;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CityEntity::class);
    }

    /** @return CityEntity[] */
    public function getAllCities(): array
    {
        return $this->createQueryBuilder('c1')
            ->select('c1')
            ->groupBy('c1.cityName')
            ->orderBy('c1.cityName')
            ->getQuery()
            ->getResult();
    }

    public function getByName(string $cityName): CityEntity
    {
        $city = $this->findOneBy(['cityName' => $cityName]);
        if ($city === null) {
            throw new RuntimeException('Unable to find city');
        }

        return $city;
    }

    /** @param Generator<CityEntity> $entities */
    public function saveEntities(Generator $entities): void
    {
        $bulkSize = 0;
        $entityManager = $this->getEntityManager();
        foreach ($entities as $entity) {
            $bulkSize++;
            $entityManager->persist($entity);

            if ($bulkSize < self::BULK_SIZE) {
                continue;
            }

            $entityManager->flush();
            $entityManager->clear(CityEntity::class);
            $bulkSize = 0;
        }
    }
}
