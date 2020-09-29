<?php

declare(strict_types=1);

namespace App\Infrastructure\Unpacker;

use App\Infrastructure\FileStorage\FileStorage;
use PharData;
use PharFileInfo;

use function assert;

use const DIRECTORY_SEPARATOR;

class GeoLite2Unpacker
{
    private FileStorage $fileStorage;

    public function __construct(FileStorage $fileStorage)
    {
        $this->fileStorage = $fileStorage;
    }

    public function unpack(string $archiveFile, string $unpackedFile): void
    {
        $archive = new PharData($archiveFile);
        $databaseFolder = $this->getPathContainingDatabaseFile($archive);
        $databaseFile = $databaseFolder . '/GeoLite2-City.mmdb';
        $tempFolder = $this->fileStorage->getTemporaryFolder();
        $temporaryUnpackedFile = $tempFolder . DIRECTORY_SEPARATOR . $databaseFile;

        $archive->extractTo($tempFolder, $databaseFile, true);

        $this->fileStorage->rename($temporaryUnpackedFile, $unpackedFile, true);
        $this->fileStorage->remove($this->fileStorage->getPathForTemporaryFile($databaseFolder));
    }

    private function getPathContainingDatabaseFile(PharData $archive): string
    {
        $folder = $archive->current();
        assert($folder instanceof PharFileInfo);

        return $folder->getFilename();
    }
}
