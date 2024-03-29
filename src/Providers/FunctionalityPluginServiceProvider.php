<?php

namespace FunctionalityPlugin\Providers;

use FunctionalityPlugin\Frontend;
use FunctionalityPlugin\Admin;
use Illuminate\Support\ServiceProvider;

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

        $this->app->singleton('functionality_plugin.contact_information', function () {
            return new \FunctionalityPlugin\ContactInformation();
        });

        $this->app->singleton('functionality_plugin.social_media', function () {
            return new \FunctionalityPlugin\SocialMedia();
        });
    }
    
    public function boot()
    {
        collect([
            Frontend::class,
            Admin::class,
        ])
            ->each(function ($class) {
                (new $class())->runHooks();
            });
    }
}
