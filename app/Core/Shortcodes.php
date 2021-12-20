<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * WordPress shortcodes
 */
class Shortcodes
{

    /**
     * Shortcode callback
     *
     * @param  array $atts The shortcut attributes.
     * @return string
     */
    public function foobarFunc($atts = []) : string
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
