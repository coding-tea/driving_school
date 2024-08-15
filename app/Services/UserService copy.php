<?php

namespace App\Services;

use App\DTO\UserDto;
use App\Enums\Status;
use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    public function __construct(private ImageService $imageService)
    {
    }

    /***
     *
     * @return
     */
    public function query()
    {
        return User::query();
    }

    public function generateForCollaborator(Collaborator $collaborator)
    {
        $this->query()->create([
            'status' => Status::ACTIVE->value,
            'collaborator' => $collaborator->id,
            'created_by' => user()->id,
        ]);

    }

    public function delete(User $user): void
    {
        $this->imageService->delete($user['image']);
        $user->delete();
    }

    public function deleteFromArrayOfIds(array $ids): void
    {
        self::query()->whereIn('id', $ids)->delete();
    }

    public function deleteFromCollectionOfUsers(Collection $users): void
    {
        $users->delete();
    }

    public function update(User $user, UserDto $userDto)
    {


        $user->fill([
            'first_name' => $userDto->first_name,
            'last_name' => $userDto->last_name,
            'cin' => $userDto->cin,
            'dob' => $userDto->dob,
            'login' => $userDto->login,
            'description' => $userDto->description,
            'gender' => $userDto->gender,
            'civility' => $userDto->civility,
            'phone_number' => $userDto->phone_number,
            'city' => $userDto->city,
        ]);

        if ($user->isDirty()) {
            $user->save();
            $user->refresh();
        }

        if (isset($userDto->image)) {

            $this->imageService->update($user, $userDto->image);
        }

    }

    public function resetPassword(User $user , $updatedBy = null)
    {
        if($user->hasOwner()){
            $collaborator = $user->owner;
            $user->update([
                'password' => \Hash::make($collaborator->dto()->passwordFormat()),
                'password_initialized_at' => now()->toDateTimeString(),
                'password_updated_at' => now()->toDateTimeString(),
                'updated_by' => $updatedBy,
                'is_password_dirty' => false,
            ]);
        }
    }
    public function updateStatus(User $user ,$status = null, $updatedBy = null): void
    {
        if($user->hasOwner()){

            $user->update([
                'status' => Status::tryFrom($status)->value ,
                'updated_by' => $updatedBy,
            ]);
        }
    }

    public function updateRole(User $user , $status = null , $updatedBy = null): void
    {
        if($user->hasOwner()){
            $collaborator = $user->owner;
            $user->update([
                'status' => Status::tryFrom($status)->value ,
                'updated_by' => $updatedBy,
            ]);
        }
    }
    public function updateIsManager(User $user , $updatedBy = null): void
    {
        if($user->hasOwner()){
            $collaborator = $user->owner;
            $user->update([
                'is_manager' => \Hash::make($collaborator->dto()->passwordFormat()),
                'updated_by' => $updatedBy,
            ]);
        }
    }

    public function getUnAssignedAccount()
    {
        return $this->query()->whereNull('collaborator')->get();
    }

}
