<?php

namespace App\EditConsult;

use App\Enums\Civility;
use App\Enums\Gender;
use App\Interfaces\ConsultationInterface;
use App\Rules\Rules;
use App\Rules\UniqueValue;
use App\View\Action;
use App\View\Head;
use Illuminate\Validation\Rule;

class UsersEditConsult extends Consultation implements ConsultationInterface
{
    /***
     * Users datatable actions
     * @return array
     */
    public static function actions(): array
    {
        return [
            // TODO: ADD THIS LINKS FOR EXPORT AND IMPORT DATA USERS

            // TODO: ADD THIS LINKS FOR ADD AND DELETE DATA USERS
            new Action(ucwords(trans('app.add')), Action::TYPE_NORMAL, url: route('users.create')),
            new Action((trans('app.delete_all')), Action::TYPE_DELETE_ALL, url: route('users.destroyGroup')),
            new Action(ucwords(trans('users.page_create.page_title')), Action::TYPE_NORMAL, url: route('users.create')),
            new Action((trans('users.page_index.page_dt_action_delete_all')), Action::TYPE_DELETE_ALL, url: route('users.destroyGroup')),
        ];
    }
    /***
     * Users datatable columns
     * @return  array
     */
    public static function heads(): array
    {
        return [

            new Head('', Head::TYPE_TEXT, trans('users.page_index.page_th_user')),
            new Head('', Head::TYPE_TEXT, trans('app.cin')),
            new Head('', Head::TYPE_TEXT, trans('app.description')),
            new Head('', Head::TYPE_TEXT, trans('app.dob')),
            new Head('', Head::TYPE_TEXT, trans('app.gender')),
            new Head('', Head::TYPE_TEXT, trans('app.civility')),
            new Head('', Head::TYPE_TEXT, trans('app.city')),
            new Head('', Head::TYPE_TEXT, trans('app.status')),
            new Head('', Head::TYPE_TEXT, trans('app.role')),
            new Head('', Head::TYPE_TEXT, trans('app.actions')),
        ];
    }


}
