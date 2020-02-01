Rekamy Generator
================

This Generator will generate a complete CRUD with Repository Design Pattern along with the Swagger API Documentation.

## Installing Rekamy Generator

The recommended way to install Rekamy Generator is through Composer.

```bash
composer require rekamy/generator
```

Next, you will need to publish the generator.

```bash
php artisan vendor:publish --provider "Rekamy\ApiGenerator\ApiGeneratorServiceProvider"
```