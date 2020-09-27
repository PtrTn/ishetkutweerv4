<?php

namespace App\Infrastructure\ApiClient;

use App\Application\ApiClient\BuienradarApiClientInterface;
use App\Application\Dto\Buienradar\BuienradarnlDto;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use RuntimeException;

class BuienradarApiClient implements BuienradarApiClientInterface
{
    private const API_URL = 'http://xml.buienradar.nl/';

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

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
        /** @var BuienradarnlDto $data */
        $data = $this->serializer->deserialize($data, BuienradarnlDto::class, 'xml');
        return $data;
    }
}
