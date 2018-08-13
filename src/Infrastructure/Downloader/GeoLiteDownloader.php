<?php

namespace App\Infrastructure\Downloader;

use GuzzleHttp\Client;
use PharData;
use Symfony\Component\Filesystem\Filesystem;

class GeoLiteDownloader
{
    private const DATA_URL = 'http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.tar.gz';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $downloadFolder;

    /**
     * @var string
     */
    private $dataFolder;

    public function __construct(Client $client, Filesystem $filesystem, string $downloadFolder, string $dataFolder)
    {
        $this->client = $client;
        $this->filesystem = $filesystem;
        $this->downloadFolder = $downloadFolder;
        $this->dataFolder = $dataFolder;
    }

    public function download(): void
    {
        $this->createDirectoriesIfMissing();

        $downloadLocation = $this->downloadFolder . '/download.tar.gz';
        $this->client->get(
            self::DATA_URL,
            [
                'sink' => $downloadLocation
            ]
        );

        $unpackedFileLocation = $this->unzipDownload($downloadLocation);

        $this->filesystem->rename($unpackedFileLocation, $this->dataFolder . '/GeoLite2-City.mmdb', true);
        $this->filesystem->remove($this->downloadFolder);
    }

    private function createDirectoriesIfMissing(): void
    {
        if (!$this->filesystem->exists($this->downloadFolder)) {
            $this->filesystem->mkdir($this->downloadFolder);
        }
        if (!$this->filesystem->exists($this->dataFolder)) {
            $this->filesystem->mkdir($this->dataFolder);
        }
    }

    private function unzipDownload(string $downloadLocation): string
    {
        $phar = new PharData($downloadLocation);
        /** @var \PharFileInfo $folder */
        $folder = $phar->current();
        $filePath = $folder->getFilename() . '/GeoLite2-City.mmdb';
        $unpackedFileLocation = $this->downloadFolder . '/' . $filePath;
        $phar->extractTo($this->downloadFolder, $filePath, true);
        return $unpackedFileLocation;
    }

}
