<?php

namespace App\Providers;

use App\Services\AudienceService;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AudienceService::class,
            AudienceService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        setlocale(LC_ALL, 'ru_RU.utf8');
        Carbon::setLocale(config('app.locale'));
    }
}
