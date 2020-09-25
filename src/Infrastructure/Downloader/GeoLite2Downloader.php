<?php

namespace App\Infrastructure\Downloader;

use App\Infrastructure\FileStorage\FileStorage;
use App\Infrastructure\Unpacker\GeoLite2Unpacker;

class GeoLite2Downloader
{
    private const DATA_URL = 'https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City&license_key=YOUR_LICENSE_KEY&suffix=tar.gz';

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

    /** @var string */
    private $licenseKey;

    public function __construct(
        FileStorage $fileStorage,
        GuzzleDownloader $downloader,
        GeoLite2Unpacker $unpacker,
        string $licenseKey
    ) {
        $this->fileStorage = $fileStorage;
        $this->downloader = $downloader;
        $this->unpacker = $unpacker;
        $this->licenseKey = $licenseKey;
    }

    public function download()
    {
        $downloadFile = $this->fileStorage->getPathForTemporaryFile('GeoLite2-database.tar.gz');
        $unpackedFile = $this->fileStorage->getPathForDataFile('GeoLite2-City.mmdb');

        $url = str_replace('YOUR_LICENSE_KEY', $this->licenseKey, self::DATA_URL);
        $this->downloader->download($url, $downloadFile);
        $this->unpacker->unpack($downloadFile, $unpackedFile);

        $this->fileStorage->remove($downloadFile);
    }

}
