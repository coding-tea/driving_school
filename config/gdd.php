<?php
return [


    /*
    |--------------------------------------------------------------------------
    | Password Reset Timeout
    |--------------------------------------------------------------------------
    | Control how mush reset password link will be usable
    */
    'reset_password_expiration_link' => 30,
    /*
    |--------------------------------------------------------------------------
    | File upload sizing
    |--------------------------------------------------------------------------
    | This will use inside any validation that contain file upload
    | image_upload_max_size : default image upload size
    | file_upload_max_size : default file upload size
    */
    'image_upload_max_size' => 3000,
    'file_upload_max_size' => 3000,

    /*
    |--------------------------------------------------------------------------
    | Generating
    |--------------------------------------------------------------------------
    |
    */
    'user_password_format' => 'cin@nom-genre',

    /*
    |--------------------------------------------------------------------------
    | Lang
    |--------------------------------------------------------------------------
    |
    */
    'available_languages' => [
        [
            'lang' => 'fr',
            'label' => 'francais',
            'icon' => '/assets/media/flags/france.svg',
        ],
        [
            'lang' => 'ar',
            'label' => 'arabic',
            'icon' => '/assets/media/flags/morocco.svg',
        ]
    ],



    'social_media' => [
        'facebook' =>  env('APP_SOCIAL_MEDIA_FACEBOOK') ,
        'twitter' =>  env('APP_SOCIAL_MEDIA_TWITTER') ,
        'instagram' =>  env('APP_SOCIAL_MEDIA_INSTAGRAM') ,
        'linkedin' =>  env('APP_SOCIAL_MEDIA_LINKEDIN') ,
    ]


];
