<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PreferenceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(
            [\App\GaelO\UseCases\GetPreference\GetPreferences::class,
            \App\GaelO\UseCases\ModifyPreference\ModifyPreference::class])
        ->needs(\App\GaelO\Interfaces\PersistenceInterface::class)
        ->give(\App\GaelO\Repositories\PreferencesRepository::class);
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