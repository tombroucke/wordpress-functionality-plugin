<?php

namespace FunctionalityPlugin\Providers;

use FunctionalityPlugin\Admin;
use FunctionalityPlugin\Console\FieldCommand;
use FunctionalityPlugin\Console\OptionsPageCommand;
use FunctionalityPlugin\Console\PostTypeCommand;
use FunctionalityPlugin\Console\SeedCommand;
use FunctionalityPlugin\Console\ShortcodeCommand;
use FunctionalityPlugin\Console\TaxonomyCommand;
use FunctionalityPlugin\ContactInformation;
use FunctionalityPlugin\Frontend;
use FunctionalityPlugin\OpeningHours;
use FunctionalityPlugin\Services\Locale;
use FunctionalityPlugin\SocialMedia;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        $this->app->singleton('functionality_plugin.base_path', function () {
            return realpath(__DIR__.'/../');
        });

        $this->app->singleton('functionality_plugin.locale', function () {
            return new Locale;
        });

        $this->app->singleton('functionality_plugin.opening_hours', function () {
            return new OpeningHours;
        });
    }

    public function boot()
    {
        $this->commands([
            PostTypeCommand::class,
            TaxonomyCommand::class,
            OptionsPageCommand::class,
            FieldCommand::class,
            ShortcodeCommand::class,
            SeedCommand::class,
        ]);

        collect([
            Frontend::class,
            Admin::class,
        ])
            ->each(function ($class) {
                (new $class)->runHooks();
            });

        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'FunctionalityPlugin',
        );

        $this->loadTextdomain();
        $this->initPostTypes();
        $this->initOptionsPages();
        $this->initFields();
        $this->initBlocks();
        $this->initShortcodes();

        Str::macro('phoneLink', function ($phone) {
            return Str::of($phone)
                ->replace(['(0)', '+'], ['', '00'])
                ->replaceMatches('/[^0-9]/', '')
                ->prepend('tel:');
        });

        Str::macro('emailLink', function ($email) {
            return Str::of(antispambot($email))
                ->prepend('mailto:');
        });
    }

    private function loadTextdomain()
    {
        add_action('init', function () {
            $muPluginRelPath = dirname(plugin_basename(__FILE__), 3).'/resources/languages/';
            load_muplugin_textdomain('functionality-plugin', $muPluginRelPath);
        }, 0);
    }

    private function initPostTypes()
    {
        collect([
            'PostTypes',
            'Taxonomies',
        ])->each(function ($registerableClassPath) {
            $this
                ->collectFilesIn("/$registerableClassPath")
                ->each(function ($filename) {
                    add_action('init', function () use ($filename) {
                        $className = $this->namespacedClassNameFromFilename($filename);
                        (new $className)
                            ->register();
                    });
                });
        });
    }

    private function initOptionsPages()
    {
        $this
            ->collectFilesIn('/OptionsPages')
            ->each(function ($filename) {
                add_action('acf/init', function () use ($filename) {
                    $className = $this->namespacedClassNameFromFilename($filename);
                    (new $className)
                        ->register();
                });
            });
    }

    private function initFields()
    {
        $this
            ->collectFilesIn('/Fields')
            ->each(function ($filename) {
                add_action('acf/init', function () use ($filename) {
                    $className = $this->namespacedClassNameFromFilename($filename);
                    (new $className)
                        ->register();
                });
            });
    }

    private function initBlocks()
    {
        $this
            ->collectFilesIn('/Blocks')
            ->each(function ($filename) {
                add_action('init', function () use ($filename) {
                    $className = $this->namespacedClassNameFromFilename($filename);
                    (new $className)
                        ->register();
                });
            });
    }

    private function initShortcodes()
    {
        $this
            ->collectFilesIn('/Shortcodes')
            ->each(function ($filename) {
                $className = $this->namespacedClassNameFromFilename($filename);
                add_shortcode($className::SHORTCODE_NAME, [new $className, 'callback']);
            });
    }

    private function collectFilesIn($path)
    {
        $fullPath = app('functionality_plugin.base_path')."/$path";

        return collect(array_merge(
            glob("$fullPath/*.php"),
            glob("$fullPath/**/*.php")
        ));
    }

    private function namespacedClassNameFromFilename($filename)
    {
        return Str::of($filename)
            ->replace(app('functionality_plugin.base_path'), '')
            ->ltrim('/')
            ->replace('/', '\\')
            ->rtrim('.php')
            ->prepend('\\FunctionalityPlugin\\')
            ->__toString();
    }
}
