<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Name
    |--------------------------------------------------------------------------
    |
    */

    'app_name' => env('APP_NAME'),


    /*
    |--------------------------------------------------------------------------
    | Generate
    |--------------------------------------------------------------------------
    |
    */

    'generate' => [

        'models'               => true,

        'controllers'          => true,

        'base_controller'      => true,

        'app_base_controller' => true,

        'repositories'         => true,

        'requests'             => true,

        'routes'               => true,

    ],

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    |
    */

    'database' => [

        'name'           => env('DB_DATABASE'),

        'exclude_tables' => [

            'migrations',

            'oauth_clients',

            'oauth_access_tokens',

            'oauth_personal_access_clients',

            'oauth_refresh_tokens',

            'oauth_auth_codes',

            'abilities',

            'roles',

            'assigned_roles',

            'permissions',

            'social_facebook_accounts',

        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    'path' => [

        'migration'             => base_path('database/migrations/'),

        'model'                 => app_path('Models/'),

        'repository'            => app_path('Repositories/'),

        'api_routes'            => base_path('routes/api.php'),

        'api_request'           => app_path('Http/Requests/API/'),

        'api_controller'        => app_path('Http/Controllers/API/'),

        'base_controller'       => app_path('Http/Controllers/'),

        'app_base_controller'   => app_path('Http/Controllers/'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace' => [

        'model'                 => 'App\Models',

        'repository'            => 'App\Repositories',

        'api_controller'        => 'App\Http\Controllers\API',

        'api_request'           => 'App\Http\Requests\API',

        'base_controller'       => 'App\Http\Controllers',

        'app_base_controller'   => 'App\Http\Controllers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    'options' => [

        'softDelete' => true,
    ]
];
