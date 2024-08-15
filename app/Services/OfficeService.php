<?php

namespace App\Services;

use App\DTO\OfficeDto as Dto;
use App\Models\Office;
use App\Models\UserManagement\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class OfficeService extends Service
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
        return Office::query();
    }

    public function create(Dto $dto)
    {
        $user = User::query()->create([
            'login' => $dto->name,
            'password' => Hash::make($dto->name),
        ]);

        $data = $this->query()->create([
            'name' => $dto->name,
            'adress' => $dto->adress,
            'user_id' => $user->id,
        ]);

        if (isset($dto->image_id)) {
            $this->imageService->save($data, $dto->image_id);
        }

        return $data;
    }

    public function delete(Office $office): void
    {
        $this->imageService->delete($office['image_id']);
        $office->delete();
    }

    public function deleteFromArrayOfIds(array $ids): void
    {
        self::query()->whereIn('id', $ids)->delete();
    }

    public function update(Office $office, Dto $dto)
    {
        $office->fill([
            'name' => $dto->name,
            'adress' => $dto->adress,
        ]);

        if ($office->isDirty()) {
            $office->save();
            $office->refresh();
        }

        if (isset($dto->image_id)) {
            $this->imageService->update($office, $dto->image_id);
        }
    }
}
