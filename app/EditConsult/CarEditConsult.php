<?php

namespace App\EditConsult;

use App\Interfaces\ConsultationInterface;
use App\View\Action;
use App\View\Head;

class CarEditConsult extends Consultation implements ConsultationInterface
{

    public static function actions(): array
    {
        $routeName = "cars";
        return [
            new Action(ucwords(trans('app.add')), Action::TYPE_NORMAL, url: route("$routeName.create")),
            new Action((trans('app.delete_all')), Action::TYPE_DELETE_ALL, url: route("$routeName.destroyGroup")),
        ];
    }

    public static function heads(): array
    {
        return [
            new Head('', Head::TYPE_TEXT, trans('cars.name')),
            new Head('', Head::TYPE_TEXT, trans('cars.date')),
            new Head('', Head::TYPE_TEXT, 'Actions'),
        ];
    }

}
