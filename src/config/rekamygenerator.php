<?php
// TODO: fix format

use Rekamy\Generator\Core\Generators\Frontend\FrontendModuleGenerator;

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

    'generators' => [
        'frontend' => [
            \Rekamy\Generator\Core\Generators\Frontend\FrontendModuleGenerator::class,
            \Rekamy\Generator\Core\Generators\Frontend\CrudManageVueGenerator::class,
            \Rekamy\Generator\Core\Generators\Frontend\CrudCreateVueGenerator::class,
            \Rekamy\Generator\Core\Generators\Frontend\CrudViewVueGenerator::class,
            \Rekamy\Generator\Core\Generators\Frontend\CrudEditVueGenerator::class,
            \Rekamy\Generator\Core\Generators\Frontend\CrudFormComponentVueGenerator::class,
        ],
        'backend' => [
            \Rekamy\Generator\Core\Generators\Backend\APIDocGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\APIDocInfoGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\AuthControllerGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\BaseControllerGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\ModelGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\BlocGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\RepositoryGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\ControllerGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\RequestGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\CrudableTraitGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\CrudableRepositoryTraitGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\HasRepositoryGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\HasRequestGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\CrudBlocGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\CrudBlocInterfaceGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\CrudControllerGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\CrudRepositoryInterfaceGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\CrudRequestInterfaceGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\ExceptionValidationGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\APIRoutesGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\DatatableCriteriaContractsGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\LengthAwarePaginatorContractsGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\ServiceProvidersGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\RequestExtensionContractsGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\BaseRepositoryContractsGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\RequestCriteriaContractsGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\FileUploadContractsGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\HasAuditorRelationGenerator::class,
            \Rekamy\Generator\Core\Generators\Backend\DependenciesSetupGenerator::class,
        ],
        'mobile' => [],
        'application' => [],
    ],


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

            // telescope
            'telescope_entries_tags',
            'telescope_entries',
            'telescope_monitoring',

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
        ],
        'include_tables' => [],
        'skipColumns' => [
            'id', 'created_at',
            // 'updated_at',
            'updated_by',
            'created_by',
            'deleted_at', 'deleted_by',
            'remark',
            'password',
            'remember_token',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    // Path is where you want the generator to generate.
    'setup' => [
        'backend' => [
            'model' => [
                'path' => app_path('Models/'),
                'namespace' => 'App\Models',
            ],
            'bloc' => [
                'path' => app_path('Bloc/'),
                'namespace' => 'App\Bloc',
            ],
            'repository' => [
                'path' => app_path('Repositories/'),
                'namespace' => 'App\Repositories',
            ],
            'controller' => [
                'path' => app_path('Http/Controllers/'),
                'namespace' => 'App\Http\Controllers',
            ],
            'request' => [
                'path' => app_path('Http/Requests/'),
                'namespace' => 'App\Http\Requests',
            ],
            'exception' => [
                'path' => app_path('Exceptions/'),
                'namespace' => 'App\Exceptions',
            ],
            'api_doc' => [
                'path' => app_path('APIDoc/'),
                'namespace' => null,
            ],
            'criteria' => [
                'path' => app_path('Contracts/Criteria/'),
                'namespace' => 'App\Contracts\Criteria',
            ],
            'override' => [
                'path' => app_path('Contracts/Overrides/'),
                'namespace' => 'App\Contracts\Overrides',
            ],
            'utilities' => [
                'path' => app_path('Contracts/Utilities/'),
                'namespace' => 'App\Contracts\Utilities',
            ],
            'providers' => [
                'path' => app_path('Providers/'),
                'namespace' => 'App\Providers',
            ],
            'crudable_trait' => [
                'path' => app_path('Contracts/Bloc/Concerns/'),
                'namespace' => 'App\Contracts\Bloc\Concerns',
            ],
            'crudable_repository_trait' => [
                'path' => app_path('Contracts/Repositories/Concerns/'),
                'namespace' => 'App\Contracts\Repositories\Concerns',
            ],
            'has_repository_trait' => [
                'path' => app_path('Contracts/Bloc/Concerns/'),
                'namespace' => 'App\Contracts\Bloc\Concerns',
            ],
            'has_request_trait' => [
                'path' => app_path('Contracts/Bloc/Concerns/'),
                'namespace' => 'App\Contracts\Bloc\Concerns',
            ],
            'has_auditor_relation_trait' => [
                'path' => app_path('Contracts/Bloc/Concerns/'),
                'namespace' => 'App\Contracts\Bloc\Concerns',
            ],
            'auth_controller' => [
                'path' => app_path('Http/Controllers/Auth/'),
                'namespace' => 'App\Http\Controllers\Auth',
            ],
            'base_controller' => [
                'path' => app_path('Http/Controllers/Base/'),
                'namespace' => 'App\Http\Controllers\Base',
            ],
            'crud_controller' => [
                'path' => app_path('Http/Controllers/Base/'),
                'namespace' => 'App\Http\Controllers\Base',
            ],
            'crud_bloc' => [
                'path' => app_path('Contracts/Bloc/Concerns/'),
                'namespace' => 'App\Contracts\Bloc\Concerns',
            ],

            'crud_repository_interface' => [
                'path' => app_path('Contracts/Repositories/'),
                'namespace' => 'App\Contracts\Repositories',
            ],
            'crud_bloc_interface' => [
                'path' => app_path('Contracts/Bloc/'),
                'namespace' => 'App\Contracts\Bloc',
            ],
            'request_interface' => [
                'path' => app_path('Contracts/Requests/'),
                'namespace' => 'App\Contracts\Requests',
            ],
            'crud_routes' => [
                'path' => base_path('routes/api/crud.php'),
                'namespace' => null,
            ],
            'api_routes' => [
                'path' => base_path('routes/api/api.php'),
                'namespace' => null,
            ],
            'web_routes' => [
                'path' => base_path('routes/web.php'),
            ],

        ],
        'frontend' => [
            'build' => 'app',
            'path' => [
                'root' => 'resources/app/',
                'module' => 'src/modules/',
                'crud' => 'src/modules/crud/',
            ],
            'source' => 'git@gitlab.com:rekamy/kopenas/frontend.git',
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
    // 'namespace' => [
    //     'model' => 'App\Models',
    //     'bloc' => 'App\Bloc',
    //     'repository' => 'App\Repositories',
    //     'controller' => 'App\Http\Controllers',
    //     'request' => 'App\Http\Requests',
    //     'exception' => 'App\Exceptions',
    //     'criteria' => 'App\Contracts\Criteria',
    //     'overrides' => 'App\Contracts\Overrides',
    //     'utilities' => 'App\Contracts\Utilities',
    //     'service_provider' => 'App\Providers',
    //     'crudable_trait' => 'App\Contracts\Bloc\Concerns',
    //     'crudable_repository_trait' => 'App\Contracts\Repository\Concerns',
    //     'has_repository_trait' => 'App\Contracts\Bloc\Concerns',
    //     'has_request_trait' => 'App\Contracts\Bloc\Concerns',
    //     'has_auditor_relation_trait' => 'App\Contracts\Bloc\Concerns',
    //     'base_controller' => 'App\Http\Controllers\Base',
    //     'crud_controller' => 'App\Http\Controllers\Base',
    //     'base_bloc' => 'App\Bloc\Base',
    //     'crud_bloc' => '',
    //     'crud_repository_interface' => '',
    //     'crud_bloc_Interface' => '',
    //     'request_interface' => '',
    //     'routes_api' => '',

    //     // 'model'                 => 'App\Models',

    //     // 'repository'            => 'App\Repositories',

    //     // 'bloc'                  => 'App\Bloc',

    //     // 'base_controller'       => 'App\Http\Controllers\Base',

    //     // 'app_base_controller'   => 'App\Http\Controllers',

    //     // 'api_request'           => 'App\Http\Requests\API',

    //     // 'api_controller'        => 'App\Http\Controllers\API',

    //     // 'web_request'           => 'App\Http\Requests',

    //     // 'web_controller'        => 'App\Http\Controllers',
    // ],

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

        'overwrite' => true,

        // if overwrite if true, control overwriting scope
        'dontOverwrite' => [
            app_path('Models/User.php'),
        ],

    ],

];
