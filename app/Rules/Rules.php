<?php

namespace App\Rules;

class Rules
{
    /***
     * validation rules for image files.
     * @return string[]
     */
    final static public function ImageValidationRules()
    {
        return ['image', new  ImageExtensionRule(), 'max:' . config('gdd.image_upload_max_size')];
    }

}
