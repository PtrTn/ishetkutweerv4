<?php

namespace App\Tests\Unit\Infrastructure\Downloader;

use App\Infrastructure\Downloader\GuzzleDownloader;
use GuzzleHttp\Client;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class GuzzleDownloaderTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function shouldDownloadUsingGuzzle()
    {
        $url  = 'http://some-url.com/and-some-other/stuff';
        $destinationFile = '/tmp/downloaded-file';

        $guzzle = Mockery::mock(Client::class);
        $guzzle->shouldReceive('get')
                ->with($url, ['sink' => $destinationFile]);

        $downloader = new GuzzleDownloader($guzzle);

        $downloader->download($url, $destinationFile);
    }

}
