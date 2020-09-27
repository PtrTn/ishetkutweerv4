<?php

namespace App\Infrastructure\Downloader;

use GuzzleHttp\Client;

class GuzzleDownloader
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function download(string $url, string $destinationFile)
    {
        $this->client->get(
            $url,
            [
                'sink' => $destinationFile
            ]
        );
    }
}
