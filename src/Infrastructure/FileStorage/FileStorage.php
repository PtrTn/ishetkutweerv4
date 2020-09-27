<?php

namespace App\Infrastructure\FileStorage;

use Symfony\Component\Filesystem\Filesystem;

class FileStorage
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $temporaryFolder;

    /**
     * @var string
     */
    private $dataFolder;

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

    private function createDirectoryIfMissing(string $directory)
    {
        if (!$this->filesystem->exists($directory)) {
            $this->filesystem->mkdir($directory);
        }
    }
}
