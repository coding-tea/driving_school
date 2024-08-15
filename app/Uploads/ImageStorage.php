<?php

namespace App\Uploads;

use Illuminate\Filesystem\FilesystemManager;

class ImageStorage
{

    protected FilesystemManager $fileSystem;

    /**
     * AttachmentService constructor.
     */
    public function __construct(FilesystemManager $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function getDisk()
    {
        return $this->fileSystem->disk(config('filesystems.images'));
    }
}
