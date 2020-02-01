Rekamy Generator
================

This Generator will generate a complete CRUD with Repository Design Pattern along with the Swagger API Documentation.

## Installing Rekamy Generator

The recommended way to install Rekamy Generator is through Composer.

```bash
composer require rekamy/generator
```

Next, you will need to publish the generator's config file by running :

```bash
php artisan vendor:publish --provider "Rekamy\ApiGenerator\ApiGeneratorServiceProvider"
```

## Configuration

Update the configuration file based on your needs.

`
    // Setup your application name here(For Swagger Use).
    'app_name' => env('APP_NAME'),
    
    // Which file would you like to generate. Set the value to false you don't want to generate.
    'generate' => [
        // ...
    ],

    // Database configuration. Set your database name here or from .env and exclude any tables you don't want to generate
    'database' => [

        // Database name
        'name'           => env('DB_DATABASE'),

        // Exclude table name
        'exclude_tables' => [
            // ...
        ]
    ],

    // Path is where you want the generator to generate.
    'path' => [
        // ...
    ],

    // Namespace for the generated files.
    'namespace' => [
        // ...
    ],

    // options is an add on you can disable these options by setting the value to false
    'options' => [
        // ...
    ]

`