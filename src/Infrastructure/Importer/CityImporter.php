<?php

declare(strict_types=1);

namespace App\Infrastructure\Importer;

use App\Application\Importer\CityImporterInterface;
use App\Infrastructure\Entity\CityEntity;
use App\Infrastructure\Repository\CityEntityRepository;
use League\Csv\Reader;
use RuntimeException;

use function array_keys;
use function count;
use function floatval;
use function intval;

final class CityImporter implements CityImporterInterface
{
    private const BULK_SIZE = 5000;

    private const HEADER = [
        self::ID_HEADING,
        self::POSTCODE_NUMBERS_HEADING,
        self::POSTCODE_CHARACTERS_HEADING,
        self::CITY_NAME_HEADING,
        self::LATITUDE_HEADING,
        self::LONGITUDE_HEADING,
    ];

    private const ID_HEADING = 'id';
    private const POSTCODE_NUMBERS_HEADING = 'postcode_numbers';
    private const POSTCODE_CHARACTERS_HEADING = 'postcode_characters';
    private const CITY_NAME_HEADING = 'city_name';
    private const LATITUDE_HEADING = 'latitude';
    private const LONGITUDE_HEADING = 'longitude';

    private Reader $csvReader;
    private CityEntityRepository $cityEntityRepository;

    public function __construct(
        Reader $csvReader,
        CityEntityRepository $cityEntityRepository
    ) {
        $this->csvReader = $csvReader;
        $this->cityEntityRepository = $cityEntityRepository;
    }

    public function import(): void
    {
        $this->csvReader->setHeaderOffset(0);
        $this->validateHeader($this->csvReader->getHeader());
        $bulk = [];
        foreach ($this->csvReader->getRecords() as $record) {
            if (count($bulk) >= self::BULK_SIZE) {
                $this->cityEntityRepository->saveEntities($bulk);
                $bulk = [];
            }

            $this->validateRecord($record);
            $bulk[] = $this->createEntity($record);
        }
    }

    /** @param string[] $header */
    private function validateHeader(array $header): void
    {
        if ($header !== self::HEADER) {
            throw new RuntimeException('Unexpected headers found');
        }
    }

    /** @param string[] $record */
    private function validateRecord(array $record): void
    {
        if (array_keys($record) !== self::HEADER) {
            throw new RuntimeException('Missing data in record');
        }
    }

    /** @param string[] $record */
    private function createEntity(array $record): CityEntity
    {
        $entity = new CityEntity();
        $entity->cityName = $record[self::CITY_NAME_HEADING];
        $entity->postcodeNumbers = intval($record[self::POSTCODE_NUMBERS_HEADING]);
        $entity->postcodeCharacters = $record[self::POSTCODE_CHARACTERS_HEADING];
        $entity->latitude = floatval($record[self::LATITUDE_HEADING]);
        $entity->longitude = floatval($record[self::LONGITUDE_HEADING]);

        return $entity;
    }
}
