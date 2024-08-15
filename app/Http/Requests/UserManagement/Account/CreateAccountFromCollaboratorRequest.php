<?php

namespace App\Http\Requests\UserManagement\Account;

use App\Enums\Status;
use App\Enums\YesNo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAccountFromCollaboratorRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'is_admin' => ['required', 'string', Rule::in(YesNo::cases())],
            'is_manager' => ['required', 'string', Rule::in(YesNo::cases())],
            'status' => ['required', 'string', Rule::in(Status::cases())],
        ];
    }
}
