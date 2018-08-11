<?php

namespace App\Infrastructure\Command;

use App\Application\QueryHandler\WeatherQueryHandler;
use App\Infrastructure\Factory\WeatherEntityFactory;
use App\Infrastructure\Repository\WeatherEntityRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportBuienradarCommand extends Command
{
    /**
     * @var WeatherQueryHandler
     */
    private $queryHandler;
    /**
     * @var WeatherEntityFactory
     */
    private $factory;
    /**
     * @var WeatherEntityRepository
     */
    private $repository;

    public function __construct(
        WeatherQueryHandler $queryHandler,
        WeatherEntityFactory $factory,
        WeatherEntityRepository $repository
    ) {
        parent::__construct();
        $this->queryHandler = $queryHandler;
        $this->factory = $factory;
        $this->repository = $repository;
    }
    
    protected function configure()
    {
        $this
            ->setName('import:buienradar')
            ->setDescription('Import data from the buienradar API')
            ->setHelp('This command will download data from xml.buienradar.nl and store it in the database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting Buienradar import');

        $output->writeln('Loading and processing API data');
        $dtos = $this->queryHandler->getWeatherData();
        $output->writeln(sprintf('Processed data for %s weerstations', count($dtos)));

        $output->writeln('Storing processed data in the database');
        $entities = [];
        foreach ($dtos as $dto) {
            $entities[] = $this->factory->createFromWeatherDto($dto);
        }
        $this->repository->saveEntities($entities);

        $output->writeln('Finished Buienradar import');
    }
}
