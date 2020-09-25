<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\ImportJobEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImportJobEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportJobEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportJobEntity[]    findAll()
 * @method ImportJobEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportJobEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportJobEntity::class);
    }

    public function save(ImportJobEntity $entity)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    public function findLastSuccessfulImport(): ?ImportJobEntity
    {
        return $this->findOneBy(['status' => 'success'], ['created' => 'desc']);
    }
}
