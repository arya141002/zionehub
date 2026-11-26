<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Filament\Forms\Components\FileUpload;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            FileUpload::configureUsing(fn (FileUpload $component) => $component->disk('s3')->visibility('public'));
        }
    }
}