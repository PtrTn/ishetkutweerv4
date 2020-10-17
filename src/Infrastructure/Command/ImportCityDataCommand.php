<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Application\CommandHandler\CityCommandHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ImportCityDataCommand extends Command
{
    private CityCommandHandler $commandHandler;

    public function __construct(CityCommandHandler $commandHandler)
    {
        parent::__construct();
        $this->commandHandler = $commandHandler;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:import:citydata')
            ->setDescription('Download data used for matching cities to a location')
            ->setHelp('This command will download a SimpleMaps database, used for doing city based location lookups');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting city data import');
        $this->commandHandler->storeCityData();
        $output->writeln('Finished importing city data');

        return 0;
    }
}
