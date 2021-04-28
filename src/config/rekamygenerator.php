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

    'package_manager' => 'npm',


    /*
    |--------------------------------------------------------------------------
    | Generate
    |--------------------------------------------------------------------------
    |
    | Which file would you like to generate. Set the value to false you 
    | don't want to generate.
    | 
    | Backend generator
    |   - model
    |   - bloc
    |   - repository
    |   - controller
    |   - request
    |   - exception_validation
    |   - apiDoc
    |   - apiDocInfo
    |   - datatable_criteria
    |   - request_extension_criteria
    |   - length_aware_paginator_overrides
    |   - base_repository_overrides
    |   - request_criteria_overrides
    |   - file_upload
    |   - app_service
    |   - crudable_trait
    |   - crudable_repository_trait
    |   - has_repository_trait
    |   - has_request_trait
    |   - has_auditor_relation_trait
    |   - auth_controller
    |   - base_controller
    |   - crud_bloc
    |   - crud_controller
    |   - crud_repository_interface
    |   - crud_bloc_Interface
    |   - request_interface
    |   - routes_api
    |
    | Frontend generator
    |   - base
    |   - route
    |   - crudIndexVue
    |   - crudIndexTS
    |   - crudCreateVue
    |   - crudCreateTS
    |   - crudViewVue
    |   - crudViewTS
    |   - crudEditVue
    |   - crudEditTS
    |   - frontendModule
    |
    */

    'generate' => [

        // 'backend' => [
        //     'model' => [
        //         'skip' => false,
        //         'class' => null,
        //     ],
        // ],

        // 'frontend' => [
        //     'base' => [
        //         'skip' => false,
        //         'class' => null,
        //     ],

        // ],

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
        'backend' => [
            'model' => app_path('Models/'),
            'bloc' => app_path('Bloc/'),
            'repository' => app_path('Repositories/'),
            'controller' => app_path('Http/Controllers/'),
            'request' => app_path('Http/Requests/'),
            'exception' => app_path('Exceptions/'),
            'api_doc' => app_path('APIDoc/'),
            'criteria' => app_path('Contracts/Criteria/'),
            'override' => app_path('Contracts/Overrides/'),
            'utilities' => app_path('Contracts/Utilities/'),
            'providers' => app_path('Providers/'),
            'crudable_trait' => app_path('Contracts/Bloc/Concerns/'),
            'crudable_repository_trait' => app_path('Contracts/Repositories/Concerns/'),
            'has_repository_trait' => app_path('Contracts/Bloc/Concerns/'),
            'has_request_trait' => app_path('Contracts/Bloc/Concerns/'),
            'has_auditor_relation_trait' => app_path('Contracts/Bloc/Concerns/'),
            'auth_controller' => app_path('Http/Controllers/Auth/'),
            'base_controller' => app_path('Http/Controllers/Base/'),
            'crud_bloc' => app_path('Contracts/Bloc/Concerns/'),
            'crud_repository_interface' => app_path('Contracts/Repositories/'),
            'crud_bloc_interface' => app_path('Contracts/Bloc/'),
            'request_interface' => app_path('Contracts/Requests/'),
            'crud_routes' => base_path('routes/crud.php'),
        ],
        'frontend' => [
            'base' => resource_path("app"),
            'route' => resource_path("app/src/router/crud"),
            'crud' => resource_path("app/src/views/crud"),
            'module' => resource_path("app/src/modules"),
        ],
        'migration' => base_path('database/migrations/'),

    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    // Namespace for the generated files.
    'namespace' => [
        'model' => 'App\Models',
        'bloc' => '',
        'repository' => '',
        'controller' => '',
        'request' => '',
        'exception_validation' => '',
        'apiDoc' => '',
        'apiDocInfo' => '',
        'datatable_criteria' => '',
        'request_extension_criteria' => '',
        'length_aware_paginator_overrides' => '',
        'base_repository_overrides' => '',
        'request_criteria_overrides' => '',
        'file_upload' => '',
        'app_service' => '',
        'crudable_trait' => '',
        'crudable_repository_trait' => '',
        'has_repository_trait' => '',
        'has_request_trait' => '',
        'has_auditor_relation_trait' => '',
        'auth_controller' => '',
        'base_controller' => '',
        'crud_bloc' => '',
        'crud_controller' => '',
        'crud_repository_interface' => '',
        'crud_bloc_Interface' => '',
        'request_interface' => '',
        'routes_api' => '',

        // 'model'                 => 'App\Models',

        // 'repository'            => 'App\Repositories',

        // 'bloc'                  => 'App\Bloc',

        // 'base_controller'       => 'App\Http\Controllers\Base',

        // 'app_base_controller'   => 'App\Http\Controllers',

        // 'api_request'           => 'App\Http\Requests\API',

        // 'api_controller'        => 'App\Http\Controllers\API',

        // 'web_request'           => 'App\Http\Requests',

        // 'web_controller'        => 'App\Http\Controllers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    // options is an add on you can disable these options by setting the value to false
    'options' => [

        // 'frontend_path' => resource_path('frontend/'),

        // 'backend_path' => base_path(),

        'softDelete' => false,

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

        'frontend_path' => 'app',

        'source' => 'git@gitlab.com:rekamy/packages/argon-template.git',

    ]
];
