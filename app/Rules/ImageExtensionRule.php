<?php

namespace App\Rules;

use App\Services\ImageService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImageExtensionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $extension = strtolower($value->getClientOriginalExtension());
        if (!ImageService::isExtensionSupported($extension)) {
            $fail(__('validation.image_extension', ['attribute' => $attribute , 'supported_extensions' => implode(',',  ImageService::getExtensionSupported()) ]));
        }
    }
}
