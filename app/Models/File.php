<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{


    protected static function booted()
    {
        // Add 'custom_key' attribute to each retrieved model
        static::retrieved(function ($model) {
            $model->content = $model->content();
        });
        static::deleted(function ($model) {


            self::fileService()->getDisk()->delete($model->getPath());
            self::fileService()->removeUnusedRichTextFiles();
        });
        static::updated(function ($model) {
            self::fileService()->removeUnusedRichTextFiles();
        });
    }


    /***
     * Get name
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /***
     * Get file path
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /***
     * Get File content
     * @return \Closure|mixed|object|string|null
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function content()
    {

        return self::fileService()->get($this->getPath());
    }



    /***
     * File Service
     * @return FileService|(FileService&\Illuminate\Contracts\Foundation\Application)|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
     */
    public static function fileService()
    {
        return app(FileService::class);
    }


    public static function findByPath($path)
    {
        return self::query()->where('path', $path)->first();
    }
}
