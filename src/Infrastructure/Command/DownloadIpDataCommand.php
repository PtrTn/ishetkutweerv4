<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Infrastructure\Downloader\GeoLite2Downloader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class DownloadIpDataCommand extends Command
{
    private GeoLite2Downloader $downloader;

    public function __construct(GeoLite2Downloader $downloader)
    {
        parent::__construct();
        $this->downloader = $downloader;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:download:ipdata')
            ->setDescription('Download data used for matching ips to a location')
            ->setHelp('This command will download GeoLite2 database, used for doing IP based location lookups');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting ip data download');
        $this->downloader->download();
        $output->writeln('Finished downloading ip data');

        return 0;
    }
}
