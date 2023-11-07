<?php

namespace FunctionalityPlugin\Shortcodes;

use FunctionalityPlugin\Contracts\Shortcode;

class ContactInformation implements Shortcode
{

    const SHORTCODE_NAME = 'contact-information';
    
    /**
     * Shortcode callback
     *
     * @param array<string, mixed>|string $atts The shortcode attributes.
     * @return string
     */
    public function callback(array|string $atts = []) : string
    {
        return view('FunctionalityPlugin::shortcodes.contact-information')->toHtml();
    }
}
