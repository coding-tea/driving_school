<?php

namespace App\DTO;

use App\Enums\Civility;
use App\Enums\Gender;
use App\Enums\Status;
use App\Enums\YesNo;
use App\Http\Requests\UserManagement\CreateCollaboratorRequest;
use App\Models\UserManagement\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class UserDto extends DTO
{
    public function __construct(

        public readonly mixed $is_admin = null,
        public readonly mixed $is_manager = null,
        public readonly mixed $status = null,
        public readonly mixed $id = null,
        public readonly mixed $login = null,
        public readonly mixed $password = null,
        public readonly mixed $is_password_dirty = null,
        public readonly mixed $password_initialized_at = null,
        public readonly mixed $password_updated_at = null,
        public readonly mixed $last_seen = null,
        public readonly mixed $collaborator = null,
        public readonly mixed $created_by = null,
        public readonly mixed $updated_by = null,
        public readonly mixed $remember_token = null,
        public readonly mixed $created_at = null,
    )
    {
    }


    public static function fromCollaboratorController($request): UserDto
    {
        return new self(
            is_admin: $request->validated('is_admin'),
            is_manager: $request->validated('is_manager'),
            status: $request->validated('status'),
        );

    }



    /***
     * Generate Password
     * @return string
     */
    // public function passwordFormat(): string
    // {
    //     // cin@Nom-Genre
    //     return $this->cin . '@' . $this->last_name . '-' . $this->gender;
    // }
//
//
//    /***
//     * Generate Password
//     * @return string
//     */
//    public function getPassword(): string
//    {
//        return Hash::make($this->login);
//    }
//
//    /***
//     * @param Request $request
//     * @return self
//     */
//    public static function fromRequest(Request $request): self
//    {
//        return new self(
//            first_name: $request->validated('first_name'),
//            last_name: $request->validated('last_name'),
//            cin: $request->validated('cin'),
//            dob: $request->validated('dob'),
//            description: $request->validated('description'),
//            gender: $request->validated('gender'),
//            login: $request->validated('login'),
//            image: $request->validated('image'),
//            status: $request->validated('status'),
//            password: $request->validated('password'),
//            is_password_dirty: $request->validated('is_password_dirty'),
//            password_initialized_at: $request->validated('password_initialized_at'),
//            password_updated_at: $request->validated('password_updated_at'),
//            city: $request->validated('city'),
//            phone_number: $request->validated('phone_number'),
//            civility: $request->validated('civility'),
//        );
//    }
//
//
//    /***
//     * @param Request $request
//     * @return self
//     */
    public static function fromModel(User $user): self
    {
        return new self(
            is_admin: $user->is_admin,
            is_manager: $user->is_manager,
            status: $user->status,
            id: $user->id,
            login: $user->login,
            password: $user->password,
            is_password_dirty: $user->is_password_dirty,
            password_initialized_at: $user->password_initialized_at,
            password_updated_at: $user->password_updated_at,
            last_seen: $user->last_seen,
            collaborator: $user->collaborator,
            created_by: $user->created_by,
            updated_by: $user->updated_by,
            remember_token: $user->remember_token,
            created_at: $user->created_at,
        );
    }
//
//
//    /***
//     *
//     * @return
//     */
//    public function fullname()
//    {
//        return $this->last_name . ' ' . $this->last_name;
//    }
//
//    /***
//     *
//     * @return
//     */
//    public function genderAsEnum()
//    {
//        return Gender::tryFrom($this->gender);
//    }
//
//    /***
//     *
//     * @return
//     */
//    public function civilityAsEnum()
//    {
//        return Civility::tryFrom($this->civility);
//    }
//
//    /***
//     *
//     * @return
//     */
    public function statusAsEnum()
    {
        return Status::tryFrom($this->status) ;
    }

    public function isAdminAsEnum(): ?YesNo
    {
        return YesNo::tryFrom($this->is_admin) ;
    }
    public function isManagerAsEnum(): ?YesNo
    {
        return YesNo::tryFrom($this->is_manager) ;
    }

//
//
//    /***
//     *
//     * @return
//     */
//    public function dbo()
//    {
//        return Carbon::parse($this->dob)->format('D , d F Y');
//    }
//
//    public function resetPassword()
//    {
//
//    }

}
