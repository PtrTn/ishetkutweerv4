<?php

namespace App\Infrastructure\Command;

use App\Infrastructure\Downloader\GeoLite2Downloader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadIpDataCommand extends Command
{
    /**
     * @var GeoLite2Downloader
     */
    private $downloader;

    public function __construct(GeoLite2Downloader $downloader)
    {
        parent::__construct();
        $this->downloader = $downloader;
    }

    protected function configure()
    {
        $this
            ->setName('download:ipdata')
            ->setDescription('Download data used for matching ips to a location')
            ->setHelp('This command will download GeoLite2 database, used for doing IP based location lookups');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting ip data download');
        $this->downloader->download();
        $output->writeln('Finished downloading ip data');
    }

}
