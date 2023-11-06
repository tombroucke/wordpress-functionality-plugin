<?php

namespace FunctionalityPlugin\Providers;

use FunctionalityPluginFrontend as Frontend;
use FunctionalityPluginAdmin as Admin;
use Roots\Acorn\ServiceProvider;

class FunctionalityPluginServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('functionality_plugin.frontend', function () {
            return new \FunctionalityPlugin\Frontend();
        });

        $this->app->singleton('functionality_plugin.admin', function () {
            return new \FunctionalityPlugin\Admin();
        });
    }
    
    public function boot()
    {
        Frontend::addAction('init', 'init');
        Admin::addAction('init', 'init');
    }
}
