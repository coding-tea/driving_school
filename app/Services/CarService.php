<?php

namespace App\Services;

use App\DTO\carDto as Dto;
use App\Models\Car;
use App\Models\Office;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CarService extends Service
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
        return car::query();
    }

    public function create(Dto $dto)
    {
        $data = $this->query()->create([
            'profil_id' => $dto->profil_id,
            'date' => $dto->date,
            'office_id' => Office::query()->where('user_id', Auth::id())->first()->id,
        ]);

        return $data;
    }

    public function delete(Car $car): void
    {
        $car->delete();
    }

    public function deleteFromArrayOfIds(array $ids): void
    {
        self::query()->whereIn('id', $ids)->delete();
    }

    public function update(Car $car, Dto $dto)
    {
        $car->fill([
            'profil_id' => $dto->profil_id,
            'date' => $dto->date,
        ]);

        if ($car->isDirty()) {
            $car->save();
            $car->refresh();
        }
    }
}
