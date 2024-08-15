<?php

namespace App\EditConsult;

use App\Interfaces\ConsultationInterface;
use App\View\Action;
use App\View\Head;

class OfficeEditConsult extends Consultation implements ConsultationInterface
{

    public static function actions(): array
    {
        $routeName = "offices";
        return [
            // new Action(ucwords('Import'), Action::TYPE_EXCEL_IMPORT, url: route($routeName . '.import')),
            // new Action(ucwords('Export'), Action::TYPE_EXCEL_EXPORT, url: route( $routeName . '.export')),
            new Action(ucwords(trans('app.add')), Action::TYPE_NORMAL, url: route("$routeName.create")),
            new Action((trans('app.delete_all')), Action::TYPE_DELETE_ALL, url: route("$routeName.destroyGroup")),
        ];
    }

    public static function heads(): array
    {
        return [
            new Head('image_id', Head::TYPE_IMG, trans('profile.image_id')),
            new Head('name', Head::TYPE_TEXT, trans('profile.name')),
            new Head('adress', Head::TYPE_TEXT, trans('profile.adress')),
            new Head('', Head::TYPE_TEXT, "Actions"),
        ];
    }

    public static function headsExported()
    {
        return [
            new Head('name', Head::TYPE_TEXT, 'name'),
            new Head('adress', Head::TYPE_TEXT, 'adress'),
        ];
    }
}
