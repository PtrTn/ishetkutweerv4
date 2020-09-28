<?php

declare(strict_types=1);

namespace App\Infrastructure\Downloader;

use GuzzleHttp\Client;

class GuzzleDownloader
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function download(string $url, string $destinationFile): void
    {
        $this->client->get(
            $url,
            ['sink' => $destinationFile]
        );
    }
}
