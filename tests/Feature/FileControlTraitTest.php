<?php

use App\Traits\FileControl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileControlTraitTest extends TestCase
{
    use RefreshDatabase, FileControl;

    /**
     * @throws Exception
     */
    public function test_can_upload_multiple_images()
    {
        //Arrange
        Storage::fake('local');
        $files = [
            UploadedFile::fake()->image('testImage1.jpg'),
            UploadedFile::fake()->image('testImage2.jpg'),
        ];
        //Act
        $uploadedFiles = $this->uploadFiles($files, 'images', 'local');
        //Assert
        Storage::disk('local')->assertExists($uploadedFiles);

    }

    /**
     * @throws Exception
     */
    public function test_can_upload_single_images()
    {
        //Arrange
        Storage::fake('local');
        $file = UploadedFile::fake()->image('testImage1.jpg');
        //Act
        $uploadedFile = $this->uploadFiles($file, 'images', 'local');
        //Assert
        Storage::disk('local')->assertExists($uploadedFile);

    }

    /**
     * @throws Exception
     */
    public function test_can_not_upload_invalid_files()
    {
        //Arrange
        Storage::fake('local');
        $file = null;
        //Act
        $this->expectException(Exception::class);
        $uploadedFile = $this->uploadFiles($file, 'images', 'local');
        //Assert
        Storage::disk('local')->assertMissing($uploadedFile);
    }

    /**
     * @throws Exception
     */
    public function test_can_delete_file()
    {
        //Arrange
        Storage::fake('local');
        $file = UploadedFile::fake()->image('testImage1.jpg');
        $uploadedFile = $this->uploadFiles($file, 'images', 'local');
        //Act
        $this->deleteFiles($uploadedFile, 'local');
        //Assert
        Storage::disk('local')->assertMissing($uploadedFile);
    }

    /**
     * @throws Exception
     */
    public function test_can_not_delete_file_does_not_exist_or_uploaded()
    {
        //Arrange
        Storage::fake('local');
        $file = UploadedFile::fake()->image('testImage1.jpg');
        //Act
        $this->expectException(Exception::class);
        $this->deleteFiles($file, 'local');
        //Assert
        Storage::disk('local')->assertMissing($file);
    }

    /**
     * @throws Exception
     */
    public function test_can_download_file()
    {
        //Arrange
        Storage::fake('local');
        $file = UploadedFile::fake()->image('testImage1.jpg');
        $uploadedFile = $this->uploadFiles($file, 'images', 'local');
        //Act
        $downloadedFiles = $this->downloadFiles($uploadedFile, 'local');
        //Assert
        $this->assertNotNull($downloadedFiles, 'Download response is null.');
        Storage::shouldReceive('disk')
            ->with('local')
            ->andReturn('local')
            ->with($downloadedFiles)
            ->andReturn($file);
    }

    /**
     * @throws Exception
     */
    public function test_can_not_download_file_does_not_exist_or_uploaded()
    {
        //Arrange
        Storage::fake('local');
        $file = UploadedFile::fake()->image('testImage1.jpg');
        //Act
        $this->expectException(Exception::class);
        $downloadedFiles = $this->downloadFiles($file, 'local');
        //Assert
        $this->assertNull($downloadedFiles, 'Download response is null.');
    }

    /**
     * @throws Exception
     */
    public function test_can_rename_file()
    {
        // Arrange
        Storage::fake('local');
        $file = UploadedFile::fake()->image('testImage1.jpg');
        $uploadedFile = $this->uploadFiles($file, 'images', 'local')[0];
        // Act
        $this->renameFile($uploadedFile, 'NewFile', 'local');
        // Assert
        Storage::disk('local')->assertMissing($uploadedFile);
        Storage::disk('local')->assertExists('NewFile');
    }

    public function test_can_not_rename_file_does_not_exist_or_uploaded()
    {
        // Arrange
        Storage::fake('local');
        $file = UploadedFile::fake()->image('testImage1.jpg');
        // Act
        $this->expectException(Exception::class);
        $this->renameFile($file, 'NewFile', 'local');
        // Assert
        Storage::disk('local')->assertMissing($file);
        Storage::disk('local')->assertMissing('NewFile');
    }


}

