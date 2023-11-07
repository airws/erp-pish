<?php

namespace App\Providers;

use App\Contracts\ISetDocumentData;
use App\Services\Generators\SetDocumentWithTemplate;
use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ISetDocumentData::class, SetDocumentWithTemplate::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
