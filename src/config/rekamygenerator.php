<?php
// TODO: fix format
return [

    /*
    |--------------------------------------------------------------------------
    | App Name
    |--------------------------------------------------------------------------
    | 
    | Setup your application name here(For Swagger Use).
    | 
    */

    'app_name' => env('APP_NAME', 'Swagger API Documentation'),


    /*
    |--------------------------------------------------------------------------
    | Generate
    |--------------------------------------------------------------------------
    |
    | Which file would you like to generate. Set the value to false you 
    | don't want to generate.
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

        // 'web_requests'         => true,

        // 'web_routes'           => true,

        // 'web_controllers'      => true,

        // 'module_views'         => true,

        'swagger_api_doc'      => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    |
    | Database configuration. Set your database name here or 
    | from .env and exclude any tables you don't want to generate
    |
    */

    'database' => [

        // Database name
        'name'           => env('DB_DATABASE'),

        // Exclude table name
        'exclude_tables' => [
            // laravel
            'migrations',
            'failed_jobs',
            'password_resets',

            // spatie permission
            'model_has_permissions',
            'model_has_roles',
            'permissions',
            'roles',
            'role_has_permissions',

            // passport
            'oauth_access_tokens',
            'oauth_auth_codes',
            'oauth_clients',
            'oauth_personal_access_clients',
            'oauth_refresh_tokens',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    // Path is where you want the generator to generate.
    'path' => [

        'migration'             => base_path('database/migrations/'),

        'model'                 => app_path('Models/'),

        'repository'            => app_path('Repositories/'),

        'bloc'                  => app_path('Bloc/'),

        'base_controller'       => app_path('Http/Controllers/Base/'),

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

    // Namespace for the generated files.
    'namespace' => [

        'model'                 => 'App\Models',

        'repository'            => 'App\Repositories',

        'bloc'                  => 'App\Bloc',

        'base_controller'       => 'App\Http\Controllers\Base',

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

    // options is an add on you can disable these options by setting the value to false
    'options' => [

        'frontend_path' => resource_path('frontend/'),
        
        'backend_path' => base_path(),

        'softDelete' => true,

        'relation' => true,

        'dontOverwrite' => [
            app_path('Models/User.php')
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Template Path To Be Generate
    |--------------------------------------------------------------------------
    |
    */

    'template' => [

        'vendor_files' => false,

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
