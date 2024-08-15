<?php

namespace App\DataTable\UserManagement;

use App\DataTable\DataTable;
use \App\Interfaces\DataTableInterface as DataTableInterface;
use App\View\Action;
use App\View\Head;

class CollaboratorDataTable extends DataTable implements DataTableInterface
{

    public static function actions(): array
    {

        return [
            new Action(ucwords(trans('app.add')), Action::TYPE_NORMAL, url: route('collaborators.create')),
            new Action((trans('app.delete_all')), Action::TYPE_DELETE_ALL, url: route('collaborators.destroyGroup')),
        ];
    }
    public static function actionss(): array
    {

        return [
            new Action(ucwords('Import'), Action::TYPE_EXCEL_IMPORT, url: route('collaboratorss.import')),
            new Action(ucwords('Export'), Action::TYPE_EXCEL_EXPORT, url: route('collaboratorss.export')),
            new Action(ucwords(trans('app.add')), Action::TYPE_NORMAL, url: route('collaboratorss.create')),
            new Action((trans('app.delete_all')), Action::TYPE_DELETE_ALL, url: route('collaboratorss.destroyGroup')),
        ];
    }
    public static function heads(): array
    {
        return [
           ...self::onlyCollaboratorHeads(),
            new Head('', Head::TYPE_TEXT, trans('users.roles.admin')),
            new Head('', Head::TYPE_TEXT, trans('users.roles.manager')),
            new Head('', Head::TYPE_TEXT, trans('app.status')),
            new Head('', Head::TYPE_TEXT, trans('auth.log_in')),
            new Head('', Head::TYPE_TEXT, 'actions'),
        ];
    }


    public static function onlyCollaboratorHeads()
    {
        return [
            new Head('', Head::TYPE_TEXT,trans('users.page_index.page_th_user')),
            new Head('', Head::TYPE_TEXT,trans('app.cin')),
            new Head('', Head::TYPE_TEXT,trans('matricule')),
            new Head('', Head::TYPE_TEXT,trans('app.dob')),
            new Head('', Head::TYPE_TEXT,trans('app.gender')),
            new Head('', Head::TYPE_TEXT,trans('app.civility')),
            new Head('', Head::TYPE_TEXT,trans('app.email')),
            new Head('', Head::TYPE_TEXT,trans('app.phone_number')),
            new Head('', Head::TYPE_TEXT,trans('app.city')),
            new Head('', Head::TYPE_TEXT,trans('establishments.postal_code')),
            new Head('', Head::TYPE_TEXT,trans('demandeur.adress')),
            new Head('', Head::TYPE_TEXT,trans('establishments.observations')),
            new Head('', Head::TYPE_TEXT,trans('enseignant')),
            new Head('', Head::TYPE_TEXT,trans('app.category_id')),
            new Head('', Head::TYPE_TEXT,trans('app.function_id')),
            new Head('', Head::TYPE_TEXT,trans('contract_type_id')),
        ];

    }

    public static function onlyCollaboratorsHeads()
    {
        return [
            new Head('', Head::TYPE_TEXT,trans('users.page_index.page_th_user')),
            new Head('', Head::TYPE_TEXT,trans('app.cin')),
            new Head('', Head::TYPE_TEXT,trans('matricule')),
            new Head('', Head::TYPE_TEXT,trans('app.dob')),
            new Head('', Head::TYPE_TEXT,trans('app.gender')),
            new Head('', Head::TYPE_TEXT,trans('app.civility')),
            new Head('', Head::TYPE_TEXT,trans('app.email')),
            new Head('', Head::TYPE_TEXT,trans('app.phone_number')),
            new Head('', Head::TYPE_TEXT,trans('app.city')),
            new Head('', Head::TYPE_TEXT,trans('establishments.postal_code')),
            new Head('', Head::TYPE_TEXT,trans('demandeur.adress')),
            new Head('', Head::TYPE_TEXT,trans('establishments.observations')),
            new Head('', Head::TYPE_TEXT,trans('app.category_id')),
            new Head('', Head::TYPE_TEXT,trans('app.function_id')),
            new Head('', Head::TYPE_TEXT,trans('contract_type_id')),
            new Head('', Head::TYPE_TEXT, 'actions'),
        ];

    }

    public static function ExportHeads(): array
    {
        return [
            new Head('matricule', Head::TYPE_TEXT, 'matricule'),
            new Head('cin', Head::TYPE_TEXT, 'cin'),
            new Head('last_name', Head::TYPE_TEXT, 'last_name'),
            new Head('first_name', Head::TYPE_TEXT, 'first_name'),
            new Head('dob', Head::TYPE_TEXT, 'dob'),
            new Head('gender', Head::TYPE_TEXT, 'gender'),
            new Head('civility', Head::TYPE_TEXT, 'civility'),
            new Head('phone_number', Head::TYPE_TEXT, 'phone_number'),
            new Head('email', Head::TYPE_TEXT, 'email'),
            new Head('city', Head::TYPE_TEXT, 'city'),
            new Head('postal_code', Head::TYPE_TEXT, 'postal_code'),
            new Head('address', Head::TYPE_TEXT, 'address'),
            new Head('observation', Head::TYPE_TEXT, 'observation'),
            new Head('function_id', Head::TYPE_TEXT, 'function_id'),
            new Head('category_id', Head::TYPE_TEXT, 'category_id'),
            new Head('contract_type_id', Head::TYPE_TEXT, 'contract_type_id'),

        ];
    }
}
