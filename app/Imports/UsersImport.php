<?php

namespace App\Imports;

use App\Enums\Gender;
use App\Models\UserManagement\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel , WithHeadingRow
{
    use Importable;

    public function model(array $row): User
    {

        //TODO: Validating data excel
        $validated = Validator::make($row, [

            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob' => 'required|date',
            'cin' => ['required', 'max:255', 'unique:users,cin'],
            'email' => ['required', 'max:255', 'unique:users,email'],
            'description' => 'nullable|string',
            'gender' => ['required', 'string', Rule::in(Gender::cases())],
            'password' => ['required'],

        ]);

        //TODO: Hashing password
        $validated->validated()['password'] = Hash::make($validated->validated()['password']);

        //TODO: Save user
        return new User($validated->validated());
    }

}
