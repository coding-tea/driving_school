<?php

namespace App\EditConsult;

use App\Interfaces\ConsultationInterface;
use App\View\Action;
use App\View\Head;

class ProfileEditConsult extends Consultation implements ConsultationInterface
{

    public static function actions(): array
    {
        $routeName = "profile";
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
            new Head('image', Head::TYPE_TEXT, trans('profile.image')),
            new Head('name', Head::TYPE_TEXT, trans('profile.name')),
            new Head('name_ar', Head::TYPE_TEXT, trans('profile.name_ar')),
            new Head('cin', Head::TYPE_TEXT, trans('profile.cin')),
            new Head('adress', Head::TYPE_TEXT, trans('profile.adress')),
            new Head('birthday', Head::TYPE_TEXT, trans('profile.birthday')),
            new Head('birth_city', Head::TYPE_TEXT, trans('profile.birth_city')),
            new Head('reference', Head::TYPE_TEXT, trans('profile.reference')),
            new Head('signin_date', Head::TYPE_TEXT, trans('profile.signin_date')),
            new Head("", Head::TYPE_TEXT, "Actions"),
        ];
    }

    public static function headsExported()
    {
        return [
            new Head('name', Head::TYPE_TEXT, 'name'),
            new Head('name_ar', Head::TYPE_TEXT, 'name_ar'),
            new Head('cin', Head::TYPE_TEXT, 'cin'),
            new Head('adress', Head::TYPE_TEXT, 'adress'),
            new Head('birthday', Head::TYPE_TEXT, 'birthday'),
            new Head('birth_city', Head::TYPE_TEXT, 'birth_city'),
            new Head('reference', Head::TYPE_TEXT, 'reference'),
            new Head('signin_date', Head::TYPE_TEXT, 'signin_date'),
        ];
    }
}
