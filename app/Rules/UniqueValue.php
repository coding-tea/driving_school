<?php

namespace App\Rules;

use App\Services\Service;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;

class UniqueValue implements ValidationRule
{


    public function __construct(private Model $model)
    {


    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // TODO : check dupplicated email
        if (Service::isColumnValueUniqueExceptSelf($this->model, $attribute, $value)) {
            $fail(__('validation.unique', ['attribute' => $attribute]));
        }

    }
}
