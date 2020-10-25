<?php

declare(strict_types=1);

namespace App\Infrastructure\Locator;

use App\Domain\ValueObject\Coordinates;
use App\Domain\ValueObject\Latitude;
use App\Domain\ValueObject\Longitude;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;

class IpLocator
{
    private Reader $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getLocationForIp(?string $ipAddress): Coordinates
    {
        if ($ipAddress === null) {
            return $this->getDefaultLocation();
        }

        try {
            $city = $this->reader->city($ipAddress);
        } catch (AddressNotFoundException $e) {
            return $this->getDefaultLocation();
        } catch (InvalidDatabaseException $e) {
            return $this->getDefaultLocation();
        }

        if ($city->location->latitude === null || $city->location->longitude === null) {
            return $this->getDefaultLocation();
        }

        return new Coordinates(
            new Latitude($city->location->latitude),
            new Longitude($city->location->longitude)
        );
    }

    /**
     * Use Amsterdam as default location
     */
    private function getDefaultLocation(): Coordinates
    {
        return new Coordinates(
            new Latitude(52.30),
            new Longitude(4.77)
        );
    }
}
