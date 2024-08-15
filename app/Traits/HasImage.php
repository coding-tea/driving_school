<?php

namespace App\Traits;

use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasImage
{




    /***
     * Return Image model
     * @return HasOne
     */
    public function image(): HasOne
    {
        return $this->HasOne(Image::class, 'id', 'image_id');
    }

    /***
     * Get Image path
     * @return null
     */
    public function getImagePath()
    {
        return $this?->image?->path;
    }

    /***
     * Stram Image
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function getImageStream()
    {
        return resolve(ImageService::class)->streamImageFromModel($this->image);
    }

    /***
     * Associate Image to Model
     * @return
     */
    public function associate(Image $image): void
    {
        $this->update([
            'image_id' => $image['id']
        ]);
    }



}
