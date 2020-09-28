<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Application\Repository\WeatherEntityRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function count;
use function sprintf;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class CleanupDataCommand extends Command
{
    private WeatherEntityRepositoryInterface $repository;

    public function __construct(WeatherEntityRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        $this
            ->setName('cleanup:data')
            ->setDescription('Clean up outdated weather data')
            ->setHelp('This command will remove any outdated weather data from the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting data cleanup');
        $entities = $this->repository->getOutdatedEntities();
        $this->repository->deleteEntities($entities);
        $output->writeln(sprintf('Cleaned up %s records', count($entities)));

        return 0;
    }
}
