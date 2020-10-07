<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VisitGroupProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(
            [\App\GaelO\UseCases\CreateVisitGroup\CreateVisitGroup::class,
            \App\GaelO\UseCases\GetVisitGroup\GetVisitGroup::class,
            \App\GaelO\UseCases\DeleteVisitGroup\DeleteVisitGroup::class])
        ->needs(\App\GaelO\Interfaces\PersistenceInterface::class)
        ->give(\App\GaelO\Repositories\VisitGroupRepository::class);
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