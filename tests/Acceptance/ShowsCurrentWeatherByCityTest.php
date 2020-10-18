<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\Acceptance\Fixtures\FixtureLoader;
use App\Tests\Acceptance\Fixtures\VenloCityEntityFixture;
use App\Tests\Acceptance\Fixtures\VenloWeatherEntityFixture;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ShowsCurrentWeatherByCityTest extends WebTestCase
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

    public function testShouldShowWeatherRatingText(): void
    {
        $this->fixtureLoader->addFixture(new VenloWeatherEntityFixture());
        $this->fixtureLoader->addFixture(new VenloCityEntityFixture());
        $this->fixtureLoader->loadFixtures();

        $this->client->request('GET', '/Venlo');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('[data-test="rating-text"]', 'Het is kutweer');
    }
}
