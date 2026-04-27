<?php

namespace FunctionalityPlugin\Providers;

use FunctionalityPlugin\Admin;
use FunctionalityPlugin\ContactInformation;
use FunctionalityPlugin\Frontend;
use FunctionalityPlugin\SocialMedia;
use Illuminate\Support\ServiceProvider;

class FunctionalityPluginServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('functionality_plugin.frontend', function () {
            return new Frontend;
        });

        $this->app->singleton('functionality_plugin.admin', function () {
            return new Admin;
        });

        $this->app->singleton('functionality_plugin.contact_information', function () {
            return new ContactInformation;
        });

        $this->app->singleton('functionality_plugin.social_media', function () {
            return new SocialMedia;
        });
    }

    public function boot()
    {
        collect([
            Frontend::class,
            Admin::class,
        ])
            ->each(function ($class) {
                (new $class)->runHooks();
            });
    }
}
