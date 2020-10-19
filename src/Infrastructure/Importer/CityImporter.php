<?php

declare(strict_types=1);

namespace App\Infrastructure\Importer;

use App\Application\Importer\CityImporterInterface;
use App\Domain\Model\Cities;
use App\Domain\Model\City;
use Generator;
use League\Csv\Reader;
use RuntimeException;

use function array_keys;
use function floatval;
use function intval;

final class CityImporter implements CityImporterInterface
{
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

    public function __construct(Reader $csvReader)
    {
        $this->csvReader = $csvReader;
    }

    public function import(): Cities
    {
        $this->csvReader->setHeaderOffset(0);
        $this->validateHeader($this->csvReader->getHeader());
        $generator = $this->createGenerator();

        return new Cities($generator);
    }

    /** @param string[] $header */
    private function validateHeader(array $header): void
    {
        if ($header !== self::HEADER) {
            throw new RuntimeException('Unexpected headers found');
        }
    }

    private function createGenerator(): Generator
    {
        foreach ($this->csvReader->getRecords() as $record) {
            $this->validateRecord($record);

            yield $this->createModel($record);
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
    private function createModel(array $record): City
    {
        return new City(
            $record[self::CITY_NAME_HEADING],
            floatval($record[self::LATITUDE_HEADING]),
            floatval($record[self::LONGITUDE_HEADING]),
            intval($record[self::POSTCODE_NUMBERS_HEADING]),
            $record[self::POSTCODE_CHARACTERS_HEADING]
        );
    }
}
