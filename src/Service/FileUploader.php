<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    // private Filesystem $filesystem;
    private $targetDirectory;
    private $targetDirectoryPublic;

    public function __construct(private Filesystem $filesystem, $targetDirectory, $targetDirectoryPath)
    {
        $this->targetDirectory = $targetDirectory;
        $this->targetDirectoryPublic = $targetDirectoryPath;
    }

    public function uploadFile(UploadedFile $picture, ?string $oldPicturePath = null): string
    {
        $folder = $this->targetDirectory;
        $extension = $picture->guessExtension() ?? 'jpg';
        $filename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $filename . '-' . bin2hex(random_bytes(10)) . '.' . $extension;

        $picture->move($folder, $newFilename);

        if ($oldPicturePath) {
            $oldPicture = pathinfo($oldPicturePath, PATHINFO_BASENAME);
            $path = $this->targetDirectory . '/' . $oldPicture;
            $this->filesystem->remove($path);
        }

        return $this->targetDirectoryPublic . '/' . $newFilename;
    }
}
