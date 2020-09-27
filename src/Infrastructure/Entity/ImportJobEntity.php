<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="App\Infrastructure\Repository\ImportJobEntityRepository")
 * @Table("import_job")
 */
class ImportJobEntity
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_FAILED = 'failed';

    public const STATUS_SUCCESS = 'success';

    public const STATUS_SKIPPED = 'skipped';

    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="id")
     */
    public $identifier;

    /**
     * @var \DateTimeImmutable
     * @Column(type="datetime")
     */
    public $created;

    /**
     * @var bool
     * @Column(type="string", columnDefinition="ENUM('pending', 'failed', 'success', 'skipped')")
     */
    public $status;

    /**
     * @var string
     * @Column(type="text", nullable=true)
     */
    public $message;

    public function setStatusSuccess(): void
    {
        $this->status = self::STATUS_SUCCESS;
    }

    public function setStatusSkipped(): void
    {
        $this->status = self::STATUS_SKIPPED;
    }

    public function setStatusFailedWithMessage(string $message): void
    {
        $this->status = self::STATUS_FAILED;
        $this->message = $message;
    }
}
