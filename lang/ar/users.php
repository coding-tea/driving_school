<?php

return [

    // pages
    'page_index' => [
        'page_title' => 'قائمة المستخدمين',
        'page_dt_action_delete_all' => 'حذف المستخدمين المحددين',
        'page_th_user' => 'المستخدم',
    ],

    'page_create' => [
        'page_title' => 'إنشاء مستخدم جديد',
        'page_form_card_title' => "معلومات المستخدم",
    ],

    'page_edit' => [
        'page_title' => 'تعديل المستخدم',
        'page_title_with_user' => 'تعديل :user',
    ],
    'page_affectation' => [
        'page_title' => "تخصيص الصفحة",
        'collaborator' => "المتعاون",
        'affected_profiles' => "الملفات الشخصية المتأثرة.",
        'un_affected_profiles' => "الملفات الشخصية غير المتأثرة.",
        'profiles_affected_notification' => 'تم تأثير الملفات الشخصية بنجاح',
    ],


    'account_infos' => 'معلومات الحساب',

    // alerts
    'created_notification' => 'تم إنشاء المستخدم بنجاح',
    'updated_notification' => 'تم تحديث المستخدم بنجاح',
    'deleted_notification' => 'تم حذف المستخدم بنجاح',
    'selected_deleted_notification' => 'تم حذف المستخدمين بنجاح',
    'status_updated' => 'تم تحديث حالة المستخدم بنجاح',
    'role_updated' => 'تم تحديث دور المستخدم بنجاح',
    'password_initialized' => 'تم تهيئة كلمة المرور للمستخدم بنجاح',

    // enums

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
        'blocked' => 'محظور',
    ],

    'civility' => [
        'single' => 'أعزب',
        'married' => 'متزوج',
        'divorced' => 'مطلق',
        'widowed' => 'أرمل',
    ],

    'roles' => [
        'super_admin' => 'مدير عام',
        'admin' => 'مدير',
        'manager' => 'مدير',
        'engineer' => 'مهندس',
        'conseille' => 'مستشار',
        'administrative_agent' => 'وكيل إداري',
        'enseignant' => 'مدرس',
        'other' => 'آخرون',
    ],
];
