<?php

declare(strict_types=1);

namespace App\Infrastructure\FileStorage;

use Symfony\Component\Filesystem\Filesystem;

use const DIRECTORY_SEPARATOR;

class FileStorage
{
    private Filesystem $filesystem;

    private string $temporaryFolder;

    private string $dataFolder;

    public function __construct(Filesystem $filesystem, string $temporaryFolder, string $dataFolder)
    {
        $this->filesystem = $filesystem;
        $this->temporaryFolder = $temporaryFolder;
        $this->dataFolder = $dataFolder;

        $this->createDirectoryIfMissing($this->temporaryFolder);
        $this->createDirectoryIfMissing($this->dataFolder);
    }

    public function getTemporaryFolder(): string
    {
        return $this->temporaryFolder;
    }

    public function getDataFolder(): string
    {
        return $this->dataFolder;
    }

    public function getPathForTemporaryFile(string $filename): string
    {
        return $this->temporaryFolder . DIRECTORY_SEPARATOR . $filename;
    }

    public function getPathForDataFile(string $filename): string
    {
        return $this->dataFolder . DIRECTORY_SEPARATOR . $filename;
    }

    public function rename(string $sourceFile, string $destinationFile, bool $overwrite): void
    {
        $this->filesystem->rename($sourceFile, $destinationFile, $overwrite);
    }

    public function remove(string $path): void
    {
        $this->filesystem->remove($path);
    }

    private function createDirectoryIfMissing(string $directory): void
    {
        if ($this->filesystem->exists($directory)) {
            return;
        }

        $this->filesystem->mkdir($directory);
    }
}
