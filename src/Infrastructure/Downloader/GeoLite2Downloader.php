<?php

declare(strict_types=1);

namespace App\Infrastructure\Downloader;

use App\Infrastructure\FileStorage\FileStorage;
use App\Infrastructure\Unpacker\GeoLite2Unpacker;

use function str_replace;

class GeoLite2Downloader
{
    private const DATA_URL = 'https://download.maxmind.com/app/geoip_download' .
    '?edition_id=GeoLite2-City&license_key=YOUR_LICENSE_KEY&suffix=tar.gz';

    private FileStorage $fileStorage;

    private GuzzleDownloader $downloader;

    private GeoLite2Unpacker $unpacker;

    private string $licenseKey;

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

    public function download(): void
    {
        $downloadFile = $this->fileStorage->getPathForTemporaryFile('GeoLite2-database.tar.gz');
        $unpackedFile = $this->fileStorage->getPathForDataFile('GeoLite2-City.mmdb');

        $url = str_replace('YOUR_LICENSE_KEY', $this->licenseKey, self::DATA_URL);
        $this->downloader->download($url, $downloadFile);
        $this->unpacker->unpack($downloadFile, $unpackedFile);

        $this->fileStorage->remove($downloadFile);
    }
}
