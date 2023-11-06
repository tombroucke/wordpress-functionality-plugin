<?php

namespace FunctionalityPlugin\Shortcodes;

use FunctionalityPlugin\Contracts\Shortcode;

class OpeningHours implements Shortcode
{

    const SHORTCODE_NAME = 'opening-hours';
    
    /**
     * Shortcode callback
     *
     * @param array<string, mixed>|string $atts The shortcode attributes.
     * @return string
     */
    public function callback(array|string $atts = []) : string
    {
        return view('FunctionalityPlugin::shortcodes.opening-hours', [
            'schedule' => app()->make('functionality_plugin.opening_hours')->schedule(),
        ])->toHtml();
    }
}
