<?php

namespace App\Infrastructure\Downloader;

use App\Infrastructure\FileStorage\FileStorage;
use App\Infrastructure\Unpacker\GeoLite2Unpacker;

class GeoLite2Downloader
{
    private const DATA_URL = 'http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.tar.gz';

    /**
     * @var FileStorage
     */
    private $fileStorage;

    /**
     * @var GuzzleDownloader
     */
    private $downloader;

    /**
     * @var GeoLite2Unpacker
     */
    private $unpacker;

    public function __construct(
        FileStorage $fileStorage,
        GuzzleDownloader $downloader,
        GeoLite2Unpacker $unpacker
    ) {
        $this->fileStorage = $fileStorage;
        $this->downloader = $downloader;
        $this->unpacker = $unpacker;
    }

    public function download()
    {
        $downloadFile = $this->fileStorage->getPathForTemporaryFile('GeoLite2-database.tar.gz');
        $unpackedFile = $this->fileStorage->getPathForDataFile('GeoLite2-City.mmdb');

        $this->downloader->download(self::DATA_URL, $downloadFile);
        $this->unpacker->unpack($downloadFile, $unpackedFile);

        $this->fileStorage->remove($downloadFile);
    }

}
