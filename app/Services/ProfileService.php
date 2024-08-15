<?php

namespace App\Services;

use App\DTO\ProfileDto as Dto;
use App\Enums\Status;
use App\Models\Office;
use App\Models\Profile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProfileService extends Service
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
        return Profile::query();
    }

    public function create(Dto $dto)
    {
        $office_id = Office::query()->where('user_id', Auth::id())->first()->id;
        $profile = $this->query()->create([
            'name' => $dto->name,
            'name_ar' => $dto->name_ar,
            'cin' => $dto->cin,
            'adress' => $dto->adress,
            'birthday' => $dto->birthday,
            'birth_city' => $dto->birth_city,
            'reference' => $dto->reference,
            'signin_date' => $dto->signin_date,
            'office_id' => $office_id,
        ]);

        if (isset($dto->image)) {
            $this->imageService->save($profile, $dto->image);
        }

        // if (isset($dto->cinimage)) {
        //     $this->imageService->save($profile, $dto->cinimage, "cinimage");
        // }

        return $profile;
    }

    public function delete(Profile $profile): void
    {
        $this->imageService->delete($profile['image']);
        $this->imageService->delete($profile['cinimage']);
        $profile->delete();
    }

    public function deleteFromArrayOfIds(array $ids): void
    {
        self::query()->whereIn('id', $ids)->delete();
    }

    public function deleteFromCollection(Collection $users): void
    {
        $users->delete();
    }

    public function update(Profile $profile, Dto $dto)
    {

        $profile->fill([
            'name' => $dto->name,
            'name_ar' => $dto->name_ar,
            'cin' => $dto->cin,
            'adress' => $dto->adress,
            'birthday' => $dto->birthday,
            'birth_city' => $dto->birth_city,
            'reference' => $dto->reference,
            'signin_date' => $dto->signin_date,
        ]);

        if ($profile->isDirty()) {
            $profile->save();
            $profile->refresh();
        }

        if (isset($dto->image)) {
            // dd($dto->image);
            $this->imageService->update($profile, $dto->image);
        }

        // if (isset($dto->image)) {
        //     $this->imageService->update($profile, $dto->cinimage, "cinimage");
        // }
    }
}
