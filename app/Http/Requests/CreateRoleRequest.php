<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class CreateRoleRequest extends FormRequest
{
    public function rules(): array
    {

        return [

                "name" => "required|string|max:100",
                "nomRoleAr" => "string|max:100",
                "management" => "required|boolean",
                "descrptionFr" => "string",
                "descrptionAr" => "string",

            // "name" => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
            //     $role = Role::query()
            //         ->where($attribute, $value)
            //         ->when($this->route('role'), function ($query) {
            //             return $query->where('id', '!=', $this->route('role')->id);
            //         })
            //         ->where('guard_name', $this->request->get('guard_name'))->first();
            //     if (isset($role)) {
            //         $fail(trans('validation.unique', ['attribute' => 'name']));
            //     }
            // }],
            // "description" => ['required', 'string', 'max:255'],
            // "guard_name" => ['required', 'string', 'max:255'],
            // "is_for_manager" => ['nullable', 'int']
        ];
    }


}
