<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentationRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(
            [\App\GaelO\UseCases\CreateDocumentation\CreateDocumentation::class,
            \App\GaelO\UseCases\CreateDocumentationFile\CreateDocumentationFile::class,
            \App\GaelO\UseCases\DeleteDocumentation\DeleteDocumentation::class,
            \App\GaelO\UseCases\GetDocumentation\GetDocumentation::class,
            \App\GaelO\UseCases\GetDocumentationFile\GetDocumentationFile::class])
        ->needs(\App\GaelO\Interfaces\PersistenceInterface::class)
        ->give(\App\GaelO\Repositories\DocumentationRepository::class);
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