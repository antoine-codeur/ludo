<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Crée les dossiers s'ils n'existent pas
        Storage::makeDirectory('public/uploads/imgPosts');
        Storage::makeDirectory('public/uploads/trash');
    }
}
