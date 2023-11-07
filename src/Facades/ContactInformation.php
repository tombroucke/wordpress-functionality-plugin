<?php

namespace FunctionalityPlugin\Facades;

use Illuminate\Support\Facades\Facade;

class ContactInformation extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'functionality_plugin.contact_information';
    }
}
