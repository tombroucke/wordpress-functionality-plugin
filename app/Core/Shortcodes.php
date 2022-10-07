<?php
namespace ProjectnameNamespace\Functionality\Core;

/**
 * WordPress shortcodes
 */
class Shortcodes
{

    /**
     * Shortcode callback
     *
     * @param array<string, mixed>|string $atts The shortcut attributes.
     * @return string
     */
    public function foobarFunc(array|string $atts = []) : string
    {
        $a = shortcode_atts(
            [
                'foo' => 'something',
                'bar' => 'something else',
            ],
            $atts
        );

        return "foo = {$a['foo']}";
    }
}
