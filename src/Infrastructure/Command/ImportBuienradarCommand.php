<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Application\CommandHandler\WeatherCommandHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

use function sprintf;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
class ImportBuienradarCommand extends Command
{
    private WeatherCommandHandler $commandHandler;

    public function __construct(
        WeatherCommandHandler $commandHandler
    ) {
        parent::__construct();
        $this->commandHandler = $commandHandler;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:import:buienradar')
            ->setDescription('Import data from the buienradar API')
            ->setHelp('This command will download data from xml.buienradar.nl and store it in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting Buienradar import');

        try {
            $output->writeln('Importing and storing Buienradar data');
            $this->commandHandler->storeWeatherData();
        } catch (Throwable $e) {
            $output->writeln(sprintf('Failed Buienradar import, because "%s"', $e->getMessage()));

            return 1;
        }

        $output->writeln('Successfully finished Buienradar import');

        return 0;
    }
}
