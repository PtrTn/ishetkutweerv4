<?php

namespace App\Infrastructure\Locator;

use App\Application\Dto\LocationDto;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;

class IpLocator
{
    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getLocationForIp(string $ipAddress): LocationDto
    {
        try {
            $city = $this->reader->city($ipAddress);
        } catch (AddressNotFoundException $e) {
            return $this->getDefaultLocation();
        } catch (InvalidDatabaseException $e) {
            return $this->getDefaultLocation();
        }
        $dto = new LocationDto();
        $dto->lat = $city->location->latitude;
        $dto->lon = $city->location->longitude;
        return $dto;
    }

    /**
     * Use Amsterdam as default location
     */
    private function getDefaultLocation(): LocationDto
    {
        $dto = new LocationDto();
        $dto->lat = 52.30;
        $dto->lon = 4.77;
        return $dto;
    }
}
