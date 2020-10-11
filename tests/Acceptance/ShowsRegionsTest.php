<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\Acceptance\Fixtures\FixtureLoader;
use App\Tests\Acceptance\Fixtures\VenloWeatherEntityFixture;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ShowsRegionsTest extends WebTestCase
{
    protected KernelBrowser $client;
    private FixtureLoader $fixtureLoader;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->fixtureLoader = new FixtureLoader(self::$kernel);
        $this->fixtureLoader->createSchema();
    }

    public function tearDown(): void
    {
        $this->fixtureLoader->dropSchema();
    }

    public function testShouldListRegions(): void
    {
        $this->fixtureLoader->loadFixture(new VenloWeatherEntityFixture());

        $this->client->request('GET', '/api/regions');
        $response = $this->client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString('Venlo', $response->getContent());
    }
}
