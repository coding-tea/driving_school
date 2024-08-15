<?php

namespace App\Services\UserManagement;

use App\DTO\UserDto;
use App\DTO\UserManagement\CollaboratorDto;
use App\Models\CollaboratorEstablishment;
use App\Models\Establishment;
use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use App\Services\ImageService;
use App\Services\Service;
use App\Services\UserService;
use App\View\Components\Media\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class CollaboratorService extends Service
{

    public function __construct(private ImageService $imageService, private UserService $userService)
    {
    }

    /***
     *
     * @return
     */
    public function query(): Builder
    {
        return Collaborator::query();
    }

    public function create(
        CollaboratorDto $collaboratorDto,
        UserDto         $dto = null
    ): Model|Builder
    {
        return self::query()->create([
            'matricule' => $collaboratorDto->matricule,
            'cin' => $collaboratorDto->cin,
            'last_name' => $collaboratorDto->lastName,
            'first_name' => $collaboratorDto->firstName,
        ]);
    }

    public function createFromController(
        CollaboratorDto $collaboratorDto, UserDto $userDto = null
    ): Model|Builder
    {
        $collaborator = self::query()->create([
            'matricule' => $collaboratorDto->matricule,
            'cin' => $collaboratorDto->cin,
            'last_name' => $collaboratorDto->lastName,
            'first_name' => $collaboratorDto->firstName,
            'dob' => $collaboratorDto->dob,
            'gender' => $collaboratorDto->gender,
            'civility' => $collaboratorDto->civility,
            'phone_number' => $collaboratorDto->phoneNumber,
            'email' => $collaboratorDto->email,
//            'city' => $collaboratorDto->city,
            'postal_code' => $collaboratorDto->postalCode,
            'address' => $collaboratorDto->address,
            'observation' => $collaboratorDto->observation,
//            'function_id' => $collaboratorDto->function_id,
            'category_id' => $collaboratorDto->category_id,
            'enseignant' => $collaboratorDto->enseignant,
            'contract_type_id' => $collaboratorDto->contract_type_id,
        ]);


        if (isset($collaboratorDto->image)) {
            $this->imageService->save($collaborator, $collaboratorDto->image, "image_id");
        }

        if (isset($collaboratorDto->avatar)) {
            $this->imageService->save($collaborator, $collaboratorDto->image, "avatar");
        }


        if (isset($userDto)) {
            User::query()->create([
                'status' => $userDto->status,
                'is_admin' => $userDto->is_admin,
                'is_manager' => $userDto->is_manager,
                'login' => $collaboratorDto->matricule,
                'password' => \Hash::make($collaboratorDto->passwordFormat()),
                'collaborator' => $collaborator->id,
            ]);
        }


        return $collaborator;
    }


    public function delete(Collaborator $collaborator): void
    {
        $collaborator->delete();
        // TODO : call job
    }

    public function deleteFromArrayOfIds($ids): void
    {
        $this->query()->whereIn('id', $ids)->delete();
    }


    /***
     * @param int $count
     * @return void
     */
    public function factory(int $count = 1 , $withAccount = false)

    {
        for ($i = 0; $i < $count; $i++) {
            $Collaborator = $this->create(CollaboratorDto::fromFactory(
                [
                    'matricule' => fake()->unique()->numberBetween(100000, 999999),
                    'cin' => fake()->unique()->numberBetween(100000, 999999),
                    'last_name' => fake()->lastName,
                    'first_name' => fake()->firstName,
                ]
            ));
            if($withAccount){
                User::create([
                    'login' => $Collaborator->matricule,
                    'password' => \Hash::make($Collaborator->matricule),
                    'collaborator' => $Collaborator->id,
                ]);
            }
        }
    }


    public function all()
    {
        return $this->query()->whereNot('id', user()->owner->id)->get();
    }

    public function allWithAccount()
    {
        return $this->all()->filter(function (Collaborator $collaborator) {
            return $collaborator->hasAccount() && !$collaborator->account->isTestAccount();
        });
    }

    public function updateFromController(
        Collaborator $collaborator, CollaboratorDto $collaboratorDto, UserDto $userDto = null
    ): Model|Builder
    {

        $collaborator->fill([
            'cin' => $collaboratorDto->cin,
            'last_name' => $collaboratorDto->lastName,
            'first_name' => $collaboratorDto->firstName,
            'dob' => $collaboratorDto->dob,
            'gender' => $collaboratorDto->gender,
            'civility' => $collaboratorDto->civility,
            'phone_number' => $collaboratorDto->phoneNumber,
            'email' => $collaboratorDto->email,
//            'city' => $collaboratorDto->city,
            'postal_code' => $collaboratorDto->postalCode,
            'address' => $collaboratorDto->address,
            'observation' => $collaboratorDto->observation,
//            'function_id' => $collaboratorDto->function_id,
            'category_id' => $collaboratorDto->category_id,
            'enseignant' => $collaboratorDto->enseignant,
            'contract_type_id' => $collaboratorDto->contract_type_id,
        ]);


        if (isset($collaboratorDto->image)) {
            $this->imageService->update($collaborator, $collaboratorDto->image);
        }


        $account = $collaborator->account;

        if ($account) {
            if ($collaborator->isDirty('email')) {
                $account->update([
                    'login' => $collaboratorDto->email,

                ]);
            }
            $account->update([
                'status' => $userDto->status,
                'is_admin' => $userDto->is_admin,
                'is_manager' => $userDto->is_manager,
            ]);
        }
        if ($collaborator->isDirty()) {
            $collaborator->save();
        }

        return $collaborator;
    }


    public function updateFromProfile(
        Collaborator    $collaborator,
        CollaboratorDto $collaboratorDto
    ): Model|Builder
    {

        $collaborator->fill([
            'cin' => $collaboratorDto->cin,
            'last_name' => $collaboratorDto->lastName,
            'first_name' => $collaboratorDto->firstName,
            'dob' => $collaboratorDto->dob,
            'gender' => $collaboratorDto->gender,
            'civility' => $collaboratorDto->civility,
            'phone_number' => $collaboratorDto->phoneNumber,
            'email' => $collaboratorDto->email,
//            'city' => $collaboratorDto->city,
            'postal_code' => $collaboratorDto->postalCode,
            'address' => $collaboratorDto->address,
            'enseignant' => $collaboratorDto->enseignant,
            'observation' => $collaboratorDto->observation,
        ]);

        if ($collaborator->isDirty()) {
            $collaborator->save();
        }
        if (isset($collaboratorDto->image)) {
            $this->imageService->update($collaborator, $collaboratorDto->image);
        }


        return $collaborator;
    }

    public function resetAccountPassword(Collaborator $collaborator, $updatedBy = null): void
    {
        if ($updatedBy == null && \Auth::check()) {
            $updatedBy = \user()->id;
        }
        $this->userService->resetPassword(
            $collaborator->account,
            $updatedBy
        );
    }


    public function updateAccountStatus(Collaborator $collaborator, $updatedBy = null): void
    {
        if ($updatedBy == null && \Auth::check()) {
            $updatedBy = \user()->id;
        }
        $this->userService->updateStatus(
            $collaborator->account,
            $updatedBy
        );
    }

    public function updateAccountRole(Collaborator $collaborator, $updatedBy = null): void
    {
        if ($updatedBy == null && \Auth::check()) {
            $updatedBy = \user()->id;
        }
        $this->userService->updateRoleRole(
            $collaborator->account,
            $updatedBy
        );
    }

    public function updateAccountIsManager(Collaborator $collaborator, $updatedBy = null): void
    {
        if ($updatedBy == null && \Auth::check()) {
            $updatedBy = \user()->id;
        }
        $this->userService->updateIsManager(
            $collaborator->account,
            $updatedBy
        );
    }


    public function linkImage(Collaborator $collaborator, Image $image, $column = "image_id")
    {
        $collaborator->update([
            $column => $image->id
        ]);
    }

    public function getAllByJoined()
    {
        return self::query()
            ->join('functions', 'functions.id', 'collaborators.function_id')
            ->join('categories_collaborators', 'categories_collaborators.id', 'collaborators.category_id')
            ->join('contract_nature', 'contract_nature.id', 'collaborators.contract_type_id')
            ->select('collaborators.*', 'functions.name as function_id', 'categories_collaborators.name as category_id', 'contract_nature.name as contract_type_id')
            ->get();
    }

    public function getEstablishmentsHasCollaborator($id)
    {
        return Establishment::query()
            ->join('collaborator_establishments', 'collaborator_establishments.establishment_id', 'establishments.id')
            ->join('collaborators', 'collaborators.id', 'collaborator_establishments.collaborator_id')
            ->where('collaborators.id', $id)
            ->select('establishments.*')
            ->whereHas('collaborators')
            ->get();
    }


    public function getEstablishmentsDoesntHaveCollaborator($arrayIds)
    {

        return Establishment::query()
            ->whereNotIn('establishments.id', $arrayIds)
            ->get();
    }

    public function affectedCollaboratorEstablishment($ids, $idCollaborator): void
    {
        if (!empty($ids)) {
            $_ids = explode(',', $ids);
            CollaboratorEstablishment::query()->where('collaborator_id', $idCollaborator)->delete();
            foreach ($_ids as $id) {
                CollaboratorEstablishment::query()->create([
                    'collaborator_id' => $idCollaborator,
                    'establishment_id' => $id,
                ]);
            }
        } else {
            CollaboratorEstablishment::query()->where('collaborator_id', $idCollaborator)->delete();
        }
    }

    public function getCollaboratorForSelect(): array
    {

        return [self::query()->select('collaborators.id', \DB::raw('CONCAT(first_name , " " , last_name , " " , matricule) as full_name'))->get() , ['id' , 'full_name']] ;

    }

}
