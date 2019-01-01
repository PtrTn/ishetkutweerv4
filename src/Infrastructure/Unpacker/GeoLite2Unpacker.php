<?php

namespace App\Infrastructure\Unpacker;

use App\Infrastructure\FileStorage\FileStorage;
use PharData;

class GeoLite2Unpacker
{
    /**
     * @var FileStorage
     */
    private $fileStorage;

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
        /** @var \PharFileInfo $folder */
        $folder = $archive->current();
        return $folder->getFilename();
    }
}
