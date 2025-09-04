<?php

namespace AgusUsk\AdminLteAuth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/adminlte-auth.php', 'adminlte-auth');
    }

    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'adminlte-auth');
        
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        
        // Register routes
        $this->registerRoutes();
        
        // Publish assets
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/adminlte-auth.php' => config_path('adminlte-auth.php'),
            ], 'adminlte-auth-config');
            
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/adminlte-auth'),
            ], 'adminlte-auth-views');
        }
        
        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \AgusUsk\AdminLteAuth\Console\Commands\InstallAuthCommand::class,
            ]);
        }
    }
    
    protected function registerRoutes()
    {
        Route::group([
            'middleware' => ['web'],
            'namespace' => 'AgusUsk\AdminLteAuth\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/auth.php');
        });
    }
}