<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient;

use App\Infrastructure\Dto\Buienradar\BuienradarnlDto;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use RuntimeException;

use function assert;

class BuienradarApiClient implements BuienradarApiClientInterface
{
    private const API_URL = 'http://xml.buienradar.nl/';

    private Client $httpClient;

    private SerializerInterface $serializer;

    public function __construct(Client $httpClient, SerializerInterface $serializer)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    public function getData(): BuienradarnlDto
    {
        $response = $this->httpClient->get(self::API_URL);
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Unable to contact buienradar API');
        }

        $data = $response->getBody()->getContents();
        $data = $this->serializer->deserialize($data, BuienradarnlDto::class, 'xml');
        assert($data instanceof BuienradarnlDto);

        return $data;
    }
}
