<?php

namespace App\Services;

use App\Uploads\FileStorage;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\File;

class FileService extends Service
{
    protected static array $supportedExtensions = ['xlsx', 'docx', 'pdf', 'txt'];

    public static string $wysiwygFiles = 'wysiwyg/';

    public function __construct(
        private FileStorage $storage,
        private ImageService $imageService,
    ) {
    }

    public function upload(Model $model, UploadedFile $uploadedFile, $fileName, $column = "file")
    {
        if (!$fileName) {
            $fileName = $this->generateFileName($uploadedFile);
        } else {
            $fileName =  $fileName . "." . $uploadedFile->getClientOriginalExtension();
        }

        $path = $uploadedFile->storeAs('Files', $fileName);

        $file = File::create([
            'path' => $path
        ]);

        $model->update([
            $column => $file['id']
        ]);
    }
    static function isExtensionSupported(string $extension): bool
    {
        return in_array($extension, static::$supportedExtensions);
    }

    public static function getExtensionSupported(string $extension): array
    {
        return self::$supportedExtensions;
    }

    private function generateFileName(UploadedFile $uploadedFile): string
    {
        $originalName = $uploadedFile->getClientOriginalName();
        $extension = $uploadedFile->getClientOriginalExtension();
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);
        $fileName = preg_replace("/[^a-zA-Z0-9]+/", "", $fileName);
        $fileName = str_replace(' ', '_', $fileName);
        $fileName .= '_' . time();
        return $fileName . '.' . $extension;
    }

    public function model()
    {
        return File::query();
    }

    public function getDisk()
    {
        return $this->storage->getDisk();
    }

    public function createRichFile($fileContent = '', $folder = '')
    {

        if (empty($folder)) {
            $folder = FileService::$wysiwygFiles;
        }
        $fullPath = $folder . uniqid('', true) . '.txt';


        $this->save($fullPath, $fileContent);
        return $this->model()->create([
            'path' => $fullPath
        ]);
    }

    public function updateRichFile($path, $fileContent)
    {
        if (is_null($fileContent)) {
            $fileContent = '';
        }
        $this->save($path, $fileContent);
    }

    public function updateOrCreateRichFile($path, $fileContent)
    {
        if (is_null($fileContent)) {
            $fileContent = '';
        }
        if (is_null($path)) {
            $path = '';
        }

        if ($this->getDisk()->exists($path)) {
            $this->updateRichFile($path, $fileContent);
        } else {
            $this->createRichFile($fileContent);
        }
    }

    public function save($fileName, $fileContent = '', $folder = '')
    {
        $fullPath = $folder . $fileName;
        $this->getDisk()->put($fullPath, $fileContent);
    }


    public function deleteFile($filePath)
    {
        $this->getDisk()->delete($filePath);
    }

    public function richTextFiles()
    {
        return $this->getDisk()->allFiles('richtext');
    }

    public function get($path)
    {
        if ($this->getDisk()->exists($path)) {
            return $this->getDisk()->get($path);
        }
        return  '';
    }


    public function removeUnusedRichTextFiles()
    {
        $imagesFromDb = [];
        foreach (File::all() as $file) {

            $pattern = '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/';
            preg_match_all($pattern, $this->getDisk()->get($file['path']), $matches);
            $filesPath = $matches[1];

            foreach ($filesPath as $filePath) {
                $filePath = Str::after($filePath, 'images/');
                $imagesFromDb[] = $filePath;
            }
        }
        foreach ($this->imageService->getDisk()->allFiles(self::$wysiwygFiles) as $file) {
            if (!in_array($file, $imagesFromDb)) {
                $this->imageService->getDisk()->delete($file);
            }
        }
    }
}
