<?php

namespace App\Services;

use App\DTO\StaffDto as Dto;
use App\Models\Staff;
use Illuminate\Support\Collection;

class StaffService extends Service
{
    public function __construct()
    {
    }

    /***
     *
     * @return
     */
    public function query()
    {
        return Staff::query();
    }

    public function create(Dto $dto)
    {
        $data = $this->query()->create([
            'name' => $dto->name,
            'role' => $dto->role,
            'office_id' => auth()->user()->office->id,
        ]);

        return $data;
    }

    public function delete(Staff $staff): void
    {
        $staff->delete();
    }

    public function deleteFromArrayOfIds(array $ids): void
    {
        self::query()->whereIn('id', $ids)->delete();
    }

    public function update(Staff $staff, Dto $dto)
    {
        $staff->fill([
            'name' => $dto->name,
            'role' => $dto->role,
        ]);

        if ($staff->isDirty()) {
            $staff->save();
            $staff->refresh();
        }
    }
}
