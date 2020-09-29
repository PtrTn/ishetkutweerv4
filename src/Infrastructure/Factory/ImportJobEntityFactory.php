<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Infrastructure\Entity\ImportJobEntity;
use DateTimeImmutable;

class ImportJobEntityFactory
{
    public function createPendingImportJobEntity(): ImportJobEntity
    {
        $entity = new ImportJobEntity();
        $entity->created = new DateTimeImmutable('now');
        $entity->status = ImportJobEntity::STATUS_PENDING;

        return $entity;
    }
}
