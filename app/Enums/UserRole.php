<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = "super admin";
    case ADMIN = "admin";
    case DIRECTOR = "director";
    case ADMINISTRATEUR_ESTABLISHMENT = "administrateur establishment";
    case DIRECTOR_PEDAGOGIC = "director pedagogic";
    case ADMIN_CENTRE_FORMATION = "admin centre formation";
    case TEACHERS = "teacher";
    case STUDENTS = "students";
    case PARENT = "parent";
    case AUTRES = "autres";


    /***
     * customization of displayed values
     * no need for disclosing the name/value data directly
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => trans('users.roles.super_admin'),
            self::ADMIN => trans('users.roles.admin'),
            self::DIRECTOR => trans('director'),
            self::ADMINISTRATEUR_ESTABLISHMENT => trans('administrateur establishment'),
            self::DIRECTOR_PEDAGOGIC => trans('director pedagogic'),
            self::ADMIN_CENTRE_FORMATION => trans('admin centre formation'),
            self::TEACHERS => trans('teacher'),
            self::STUDENTS => trans('students'),
            self::PARENT => trans('parent'),
            self::AUTRES => trans('users.roles.other'),
        };
    }
    public function class(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'success',
            self::ADMIN, self::AUTRES, self::ADMIN_CENTRE_FORMATION => 'warning',
            self::DIRECTOR => 'danger',
            self::ADMINISTRATEUR_ESTABLISHMENT => 'dark',
            self::DIRECTOR_PEDAGOGIC => 'light',
            self::TEACHERS => 'secondary',
            self::STUDENTS => 'info',
            self::PARENT => 'primary',
        };
    }

    public static function toArray(): array
    {
        return [
            self::ADMIN_CENTRE_FORMATION->value => self::ADMIN_CENTRE_FORMATION->label(),
            self::ADMINISTRATEUR_ESTABLISHMENT->value => self::ADMINISTRATEUR_ESTABLISHMENT->label(),
            self::DIRECTOR_PEDAGOGIC->value => self::DIRECTOR_PEDAGOGIC->label(),
            self::TEACHERS->value => self::TEACHERS->label(),
            self::STUDENTS->value => self::STUDENTS->label(),
            self::PARENT->value => self::PARENT->label(),
        ];
    }


}
