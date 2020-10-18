<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use RuntimeException;
use Symfony\Component\HttpKernel\KernelInterface;

final class FixtureLoader
{
    private EntityManager $entityManager;
    private ORMExecutor $executor;
    private SchemaTool $schemaTool;
    private Loader $loader;

    public function __construct(KernelInterface $kernel)
    {
        $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        if (!$entityManager instanceof EntityManager) {
            throw new RuntimeException('Unable to find entity manager in container');
        }
        $this->entityManager = $entityManager;
        $this->executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $this->schemaTool = new SchemaTool($this->entityManager);
        $this->loader = new Loader();
    }

    public function createSchema(): void
    {
        $this->schemaTool->updateSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
    }

    public function dropSchema(): void
    {
        $this->schemaTool->dropSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
    }

    public function addAndLoadFixture(Fixture $fixture): void
    {
        $this->addFixture($fixture);
        $this->loadFixtures();
    }

    public function addFixture(Fixture $fixture): void
    {
        $this->loader->addFixture($fixture);
    }

    public function loadFixtures(): void
    {
        $this->executor->execute($this->loader->getFixtures());
    }
}
