<?= "
<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('auditable', function () {
            \$this->datetime('created_at')->nullable();
            \$this->datetime('updated_at')->nullable();
            \$this->datetime('deleted_at')->nullable();
            \$this->unsignedBigInteger('created_by')->nullable();
            \$this->unsignedBigInteger('updated_by')->nullable();
            \$this->unsignedBigInteger('deleted_by')->nullable();
        });

        Blueprint::macro('is', function (\$key, \$default = true, \$prefix = 'is_') {
            return \$this->boolean(\$prefix . \$key)->default(\$default)->comment('Is it ' . \$key . '?');
        });

        // !!important : Depreciated. Use Laravel Scopes db collection driver 
        Builder::macro('search', function (\$fields, \$keyword) {
            \$this->where(function (\$q) use (\$fields, \$keyword) {
                foreach (\$fields as \$index => \$field) {
                    \$q->orWhere(\$field, 'like', '%' . \$keyword . '%');
                }
            });
            return \$this;
        });

        \$this->app->bind(
            \Illuminate\Pagination\LengthAwarePaginator::class,
            \App\Contracts\Overrides\LengthAwarePaginator::class
        );

        \$this->app->bind(
            \Prettus\Repository\Criteria\RequestCriteria::class,
            \App\Contracts\Overrides\RequestCriteria::class
        );
    }
}
"
?>
