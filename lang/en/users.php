<?php

return [

    // pages
    'page_index' => [
        'page_title' => 'User List',
        'page_dt_action_delete_all' => 'Delete Selected Users',
        'page_th_user' => 'User',
    ],

    'page_create' => [
        'page_title' => 'Create a New User',
    ],

    'page_edit' => [
        'page_title' => 'Edit User',
        'page_title_with_user' => 'Edit :user',
    ],

    'page_affectation' => [
        'page_title' => "Assignment of Profiles",
        'collaborator' => "Collaborator",
        'affected_profiles' => "Affected Profiles.",
        'un_affected_profiles' => "Unaffected Profiles.",
        'profiles_affected_notification' => 'Profiles are affected successfully',
    ],


    // alerts
    'created_notification' => 'User successfully created',
    'updated_notification' => 'User successfully updated',
    'deleted_notification' => 'User successfully deleted',
    'selected_deleted_notification' => 'Users successfully deleted',
    'status_updated' => 'User status updated successfully',
    'role_updated' => 'User role updated successfully',
    'password_initialized' => 'User password initialized successfully',

    // enums
    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'blocked' => 'Blocked',
    ],

    'civility' => [
        'single' => 'Single',
        'married' => 'Married',
        'divorced' => 'Divorced',
        'widowed' => 'Widowed',
    ],

    'roles' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'manager' => 'Manager',
        'engineer' => 'Engineer',
        'conseille' => 'Advisor',
        'administrative_agent' => 'Administrative Agent',
        'other' => 'Others',
    ],
];
