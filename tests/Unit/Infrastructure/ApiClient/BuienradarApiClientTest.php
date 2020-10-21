<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\ApiClient;

use App\Infrastructure\ApiClient\BuienradarApiClient;
use App\Infrastructure\ApiClient\SorryUnableToGetData;
use App\Infrastructure\Dto\Buienradar\BuienradarnlDto;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class BuienradarApiClientTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function shouldGetData(): void
    {
        $response = Mockery::mock(ResponseInterface::class, [
            'getStatusCode' => 200,
            'getBody->getContents' => 'some-xml-string',
        ]);

        $httpClient = Mockery::mock(Client::class, ['get' => $response]);

        $serializer = Mockery::mock(SerializerInterface::class);
        $serializer->shouldReceive('deserialize')
            ->once()
            ->with('some-xml-string', BuienradarnlDto::class, 'xml')
            ->andReturn(new BuienradarnlDto());

        $client = new BuienradarApiClient($httpClient, $serializer);

        $data = $client->getData();

        $this->assertInstanceOf(BuienradarnlDto::class, $data);
    }

    /**
     * @test
     */
    public function shouldErrorOnNonSuccessStatusCode(): void
    {
        $this->expectException(SorryUnableToGetData::class);
        $this->expectExceptionMessage('Invalid status code returned from Buienradar API');

        $contents = Mockery::mock(StreamInterface::class, ['getContents' => 'test contents']);
        $response = Mockery::mock(ResponseInterface::class, [
            'getStatusCode' => 400,
            'getBody' => $contents,
        ]);
        $httpClient = Mockery::mock(Client::class, ['get' => $response]);
        $serializer = Mockery::mock(SerializerInterface::class);

        $client = new BuienradarApiClient($httpClient, $serializer);

        $client->getData();
    }
}
