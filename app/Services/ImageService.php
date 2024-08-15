<?php

namespace App\Services;

use App\Models\Image;
use App\Uploads\ImageStorage;
use BookStack\Exceptions\ImageUploadException;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService extends Service
{

    /***
     * Supported image extension
     * @var array|string[]
     */
    protected static array $supportedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private const DEFAULT_IMAGE_PLACEHOLDER = 'assets/media/default/image-placeholder.jpg';
    public const DEFAULT_PERSON = 1;
    public const DEFAULT_IMAGE = 0;
    private const DEFAULT_PERSON_PLACEHOLDER = 'assets/media/default/person-placeholder.png';


    public function __construct(private ImageStorage $storage)
    {
    }


    public function getDisk()
    {
        return $this->storage->getDisk();
    }

    /***
     * Get image stream response from path
     * @param $path
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function streamImageFromStorage($path, $default = null)
    {
        return $this->stream($path, $default);
    }

    /***
     * Get image stream response from model
     * @param Image $image
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function streamImageFromModel(Image $image)
    {
        return $this->stream($image->path, self::DEFAULT_IMAGE_PLACEHOLDER);
    }


    /***
     * Get image stream response
     * @param $path
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    protected function stream($path, $default)
    {

        if (!$this->storage->getDisk()->exists($path)) {
            $path = match ((int)$default) {
                self::DEFAULT_IMAGE => self::DEFAULT_IMAGE_PLACEHOLDER,
                self::DEFAULT_PERSON => self::DEFAULT_PERSON_PLACEHOLDER,
                default => self::DEFAULT_IMAGE_PLACEHOLDER,
            };
            return Storage::disk('public')->response($path);
        } else
            return $this->storage->getDisk()->response($path);
    }


    public function getFullPath(Image $image)
    {
        return $this->storage->getDisk()->path($image->getPath());
    }


    /***
     * Check if the given image extension is supported
     * @param string $extension
     * @return bool
     */
    public
    static function isExtensionSupported(string $extension): bool
    {
        return in_array($extension, static::$supportedExtensions);
    }

    /***
     * Get Supported extensions
     * @param string $extension
     * @return array|string[]
     */
    public
    static function getExtensionSupported(string $extension): array
    {
        return self::$supportedExtensions;
    }

    /***
     * Clean up an image file name
     * @param string $name
     * @return string
     */
    public
    function cleanImageFileName(string $name = '')
    {
        //        $name = str_replace(' ', '-', $name);
        $nameParts = $this->separateFileNameAndExtension($name);
        $extension = array_pop($nameParts);
        //        $name = implode('-', $nameParts);
        $name = time();

        return $name . '.' . $extension;
    }


    /***
     * Get file name and extension as array
     * @param $fileName
     * @return array
     */
    public
    function separateFileNameAndExtension($fileName): array
    {
        return explode('.', $fileName);
    }


    /***
     * * Save Image and associate it to a model
     * model : user , pdf ...
     * every table with image column should has relationship with image table and foreign key as image_id
     * @param Model $model
     * @param UploadedFile $uploadedFile
     * @return void
     * @throws Exception
     */
    public function save(Model $model, UploadedFile $uploadedFile, $column = "image_id")
    {
        $image = $this->saveImage($uploadedFile);
        $model->update([
            $column => $image['id']
        ]);
    }

    public function saveImage(UploadedFile $uploadedFile, $folder = '')
    {
        $disk = $this->storage->getDisk();
        $imageName = $uploadedFile->getClientOriginalName();
        $imageData = file_get_contents($uploadedFile->getRealPath());
        $fileName = $this->cleanImageFileName($imageName);
        $fullPath = $folder . $fileName;

        try {
            $disk->put($fullPath, $imageData, true);
        } catch (Exception $e) {
            Log::error('Error when attempting image upload:' . $e->getMessage());
            throw new Exception($e->getMessage());
        }
        return Image::query()->create([
            'path' => $fullPath
        ]);
    }


    /***
     * Update model image + delete old one
     * @param Model $model
     * @param UploadedFile $uploadedFile
     * @return void
     * @throws Exception
     */
    public
    function update(Model $model, UploadedFile $uploadedFile, $column = "image_id")
    {
        $this->deleteById($model->image_id);
        $this->save($model, $uploadedFile, $column);
    }


    /***
     * Delete image by id
     * @param $id
     * @return void
     */
    private
    function deleteById($id)
    {
        $image = Image::query()->find($id);
        if ($image instanceof Image) {
            $this->delete($image);
        }
    }


    /***
     * Delete image from instance
     * @return
     */
    public
    function delete(Image $image)
    {
        $disk = $this->storage->getDisk();
        if ($disk->exists($image->path)) {
            $disk->delete($image->path);
        }
        $image->delete();
    }
}
