<?php

namespace FunctionalityPlugin\Facades;

use Illuminate\Support\Facades\Facade;

class SocialMedia extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'functionality_plugin.social_media';
    }
}
