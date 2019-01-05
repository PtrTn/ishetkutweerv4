<?php

namespace App\Tests\Unit\Infrastructure\ApiClient;

use App\Infrastructure\FileStorage\FileStorage;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Component\Filesystem\Filesystem;

class FileStorageTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function shouldCreateFoldersIfNotExists()
    {
        $fileSystem = Mockery::mock(Filesystem::class);
        $fileSystem
            ->shouldReceive('exists')
            ->twice()
            ->andReturnFalse();
        $fileSystem
            ->shouldReceive('mkdir')
            ->twice();

        $temporaryFolder = __DIR__ . '/tmp';
        $dataFolder = __DIR__ . '/data';

        new FileStorage($fileSystem, $temporaryFolder, $dataFolder);
    }

    /**
     * @test
     */
    public function shouldNotCreateFoldersIfExists()
    {
        $fileSystem = Mockery::mock(Filesystem::class);
        $fileSystem
            ->shouldReceive('exists')
            ->twice()
            ->andReturnTrue();
        $fileSystem
            ->shouldNotReceive('mkdir');

        $temporaryFolder = __DIR__ . '/tmp';
        $dataFolder = __DIR__ . '/data';

        new FileStorage($fileSystem, $temporaryFolder, $dataFolder);
    }

    /**
     * @test
     */
    public function shouldRenameFile()
    {
        $sourceFile = 'some-file.jpg';
        $destinationFile = 'another-file.jpg';
        $overwrite = TRUE;

        $fileSystem = Mockery::mock(Filesystem::class);
        $fileSystem
            ->shouldReceive('exists', 'mkdir');
        $fileSystem
            ->shouldReceive('rename')
            ->with($sourceFile, $destinationFile, $overwrite)
            ->once();

        $fileStorage = new FileStorage($fileSystem, '', '');
        $fileStorage->rename($sourceFile, $destinationFile, $overwrite);
    }

    /**
     * @test
     */
    public function shouldRemoveFile()
    {
        $fileToBeRemoved = 'some-file.jpg';

        $fileSystem = Mockery::mock(Filesystem::class);
        $fileSystem
            ->shouldReceive('exists', 'mkdir');
        $fileSystem
            ->shouldReceive('remove')
            ->with($fileToBeRemoved)
            ->once();

        $fileStorage = new FileStorage($fileSystem, '', '');
        $fileStorage->remove($fileToBeRemoved);
    }

}
