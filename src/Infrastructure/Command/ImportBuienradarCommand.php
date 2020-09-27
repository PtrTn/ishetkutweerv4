<?php

namespace App\Infrastructure\Command;

use App\Application\CommandHandler\WeatherCommandHandler;
use App\Infrastructure\Factory\ImportJobEntityFactory;
use App\Infrastructure\Repository\ImportJobEntityRepository;
use Carbon\Carbon;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportBuienradarCommand extends Command
{
    private const IMPORT_INTERVAL_IN_MINUTES = 10;

    /**
     * @var ImportJobEntityFactory
     */
    private $importJobEntityFactory;

    /**
     * @var ImportJobEntityRepository
     */
    private $importJobEntityRepository;

    /**
     * @var WeatherCommandHandler
     */
    private $commandHandler;

    public function __construct(
        ImportJobEntityFactory $importJobEntityFactory,
        ImportJobEntityRepository $importJobEntityRepository,
        WeatherCommandHandler $commandHandler
    ) {
        parent::__construct();
        $this->importJobEntityFactory = $importJobEntityFactory;
        $this->importJobEntityRepository = $importJobEntityRepository;
        $this->commandHandler = $commandHandler;
    }

    protected function configure()
    {
        $this
            ->setName('import:buienradar')
            ->setDescription('Import data from the buienradar API')
            ->setHelp('This command will download data from xml.buienradar.nl and store it in the database')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Force import disregarding last import job time');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting Buienradar import');
        $importJobEntity = $this->importJobEntityFactory->createPendingImportJobEntity();
        $this->importJobEntityRepository->save($importJobEntity);

        if ($this->shouldSkip($input, $output)) {
            $importJobEntity->setStatusSkipped();
            $this->importJobEntityRepository->save($importJobEntity);
            return 0;
        }

        try {
            $output->writeln('Importing and storing Buienradar data');
            $this->commandHandler->storeWeatherData();
        } catch (Exception $e) {
            $importJobEntity->setStatusFailedWithMessage($e->getMessage());
            $this->importJobEntityRepository->save($importJobEntity);
            $output->writeln(sprintf('Failed Buienradar import, because "%s"', $e->getMessage()));
            return 1;
        }

        $importJobEntity->setStatusSuccess();
        $this->importJobEntityRepository->save($importJobEntity);
        $output->writeln('Successfully finished Buienradar import');

        return 0;
    }

    private function shouldSkip(InputInterface $input, OutputInterface $output): bool
    {
        if ($input->getOption('force') === true) {
            $output->writeln('Forcing import disregarding last job run');
            return false;
        }

        $lastImportJob = $this->importJobEntityRepository->findLastSuccessfulImport();
        if ($lastImportJob === null) {
            $output->writeln('Importing since no last job run could be found');
            return false;
        }

        $lastImportDate = Carbon::instance($lastImportJob->created);
        $diffInMinutes = $lastImportDate->diffInMinutes('now');

        if ($diffInMinutes > self::IMPORT_INTERVAL_IN_MINUTES) {
            $output->writeln(sprintf('Importing since last import was %s minutes ago', $diffInMinutes));
            return false;
        }

        $output->writeln([
            'Skipping current import, because previous job was too recent',
            sprintf(
                'Last run was %s minutes ago, waiting %s minutes till next run',
                $diffInMinutes,
                self::IMPORT_INTERVAL_IN_MINUTES - $diffInMinutes
            )
        ]);

        return true;
    }
}
