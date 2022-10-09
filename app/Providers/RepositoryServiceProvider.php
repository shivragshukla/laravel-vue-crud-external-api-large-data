<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PropertyRepositoryInterface;
use App\Repositories\PropertyRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
