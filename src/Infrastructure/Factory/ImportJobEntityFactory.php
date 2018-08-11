<?php

namespace App\Infrastructure\Factory;

use App\Infrastructure\Entity\ImportJobEntity;

class ImportJobEntityFactory
{
    public function createPendingImportJobEntity(): ImportJobEntity {
        $entity = new ImportJobEntity();
        $entity->created = new \DateTimeImmutable('now');
        $entity->status = ImportJobEntity::STATUS_PENDING;
        return $entity;
    }
}
