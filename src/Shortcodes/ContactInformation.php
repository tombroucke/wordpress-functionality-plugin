<?php

namespace FunctionalityPlugin\Shortcodes;

use FunctionalityPlugin\Contracts\Shortcode;
use Illuminate\Support\Str;

class ContactInformation implements Shortcode
{
    const SHORTCODE_NAME = 'contact-information';

    /**
     * Shortcode callback
     *
     * @param  array<string, mixed>|string  $atts  The shortcode attributes.
     */
    public function callback(array|string $atts = []): string
    {
        $a = shortcode_atts(
            [
                'property' => '',
                'branch' => 'main',
            ],
            $atts
        );
        $property = Str::of($a['property'])
            ->replace(' ', '')
            ->toString();

        $branchKey = $a['branch'];

        if ($branchKey === 'main') {
            return get_field("contact_information_{$property}", 'option') ?? '';
        }

        $branches = get_field('contact_information_branches', 'option');
        if (! $branches) {
            return '';
        }

        $branch = $branches[$branchKey] ?? null;
        if (! $branch) {
            return '';
        }

        return $branch["contact_information_{$property}"] ?? '';

    }
}
