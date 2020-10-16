<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Downloader;

use App\Infrastructure\Downloader\GeoLite2Downloader;
use App\Infrastructure\Downloader\GuzzleDownloader;
use App\Infrastructure\FileStorage\FileStorage;
use App\Infrastructure\Unpacker\GeoLite2Unpacker;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class GeoLite2DownloaderTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function shouldDownloadGeoLite(): void
    {
        $fileStorage = Mockery::mock(FileStorage::class);
        $fileStorage->shouldReceive('getPathForTemporaryFile', 'getPathForDataFile', 'remove');

        $downloader = Mockery::mock(GuzzleDownloader::class);
        $downloader->shouldReceive('download');

        $unpacker = Mockery::mock(GeoLite2Unpacker::class);
        $unpacker->shouldReceive('unpack');

        $geoLite2Downloader = new GeoLite2Downloader($fileStorage, $downloader, $unpacker, '123');

        $geoLite2Downloader->download();
    }
}
