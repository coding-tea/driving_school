<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public function getName()
    {
        return $this->name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function imageService()
    {
        return app(ImageService::class);
    }

    /***
     * Stram Image
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function getImageStream()
    {
        return $this->imageService()->streamImageFromModel($this);
    }

}
