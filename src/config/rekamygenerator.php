<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Name
    |--------------------------------------------------------------------------
    |
    */

    'app_name' => env('APP_NAME', 'Swagger API Documentation'),


    /*
    |--------------------------------------------------------------------------
    | Generate
    |--------------------------------------------------------------------------
    |
    */

    'generate' => [

        'models'               => true,

        'base_controller'      => true,

        'app_base_controller'  => true,

        'repositories'         => true,

        'api_requests'         => true,

        'api_routes'           => true,

        'api_controllers'      => true,

        'web_requests'         => true,

        'web_routes'           => true,

        'web_controllers'      => true,

        'module_views'         => true,

        'swagger_api_doc'      => true,
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

        'base_controller'       => app_path('Http/Controllers/'),

        'app_base_controller'   => app_path('Http/Controllers/'),

        'api_request'           => app_path('Http/Requests/API/'),

        'api_controller'        => app_path('Http/Controllers/API/'),

        'api_routes'            => base_path('routes/api.php'),

        'web_request'           => app_path('Http/Requests/'),

        'web_controller'        => app_path('Http/Controllers/'),

        'web_routes'            => base_path('routes/web.php'),

        'module_views'          => base_path('resources/views'),

        'layouts'               => base_path('resources/views/layouts'),

        'swagger_api_doc'       => app_path('Http/Controllers/API/Doc'),
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

        'base_controller'       => 'App\Http\Controllers',

        'app_base_controller'   => 'App\Http\Controllers',

        'api_request'           => 'App\Http\Requests\API',

        'api_controller'        => 'App\Http\Controllers\API',

        'web_request'           => 'App\Http\Requests',

        'web_controller'        => 'App\Http\Controllers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    'options' => [

        'softDelete' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Template Path To Be Generate
    |--------------------------------------------------------------------------
    |
    */

    'template' => [

        'vendor_files' => true,

        'own' => false,

        'module_views' => [

            'create' => base_path('robust-theme-template/WebCreateViewstemplate.blade.php'),

            'show'   => base_path('robust-theme-template/WebShowViewstemplate.blade.php'),

            'edit'   => base_path('robust-theme-template/WebEditViewstemplate.blade.php'),

            'index'  => base_path('robust-theme-template/WebIndexViewstemplate.blade.php'),

            'fields' => base_path('robust-theme-template/WebFieldViewstemplate.blade.php'),
        ],
    ]
];
