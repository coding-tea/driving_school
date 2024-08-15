<?php

namespace App\EditConsult\UserManagement;

use App\EditConsult\Consultation;
use App\Interfaces\ConsultationInterface;
use App\View\Action;
use App\View\Head;

class CollaboratorEditConsult  extends Consultation implements ConsultationInterface
{

    /***
     * Functions datatable actions
     * @return array
     */
    public static function actions(): array
    {
        return [

            // TODO: ADD THIS LINKS FOR ADD AND DELETE DATA USERS
            new Action(ucwords(trans('app.add')), Action::TYPE_NORMAL, url: route('collaboratorss.create')),
            new Action((trans('app.delete_all')), Action::TYPE_DELETE_ALL, url: route('collaboratorss.destroyGroup')),
        ];
    }
    /***
     * Users datatable columns
     * @return  array
     */
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
            new Head('enseignant', Head::TYPE_TEXT, 'enseignant'),
            new Head('contract_type_id', Head::TYPE_TEXT, 'contract_type_id'),

        ];
    }

}
