<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\CityEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CityEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CityEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CityEntity[]    findAll()
 * @method CityEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityEntityRepository extends ServiceEntityRepository implements CityEntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CityEntity::class);
    }

    /** @param CityEntity[] $entities */
    public function saveEntities(array $entities): void
    {
        $entityManager = $this->getEntityManager();
        foreach ($entities as $entity) {
            $entityManager->persist($entity);
        }

        $entityManager->flush();
        $entityManager->clear(CityEntity::class);
    }

    /** @return CityEntity[] */
    public function getAllEntities(): array
    {
        return $this->findAll();
    }
}
