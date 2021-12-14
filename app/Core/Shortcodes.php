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

    /**
     * Obfuscate email address with [email address="tom@tombroucke.be" class="btn btn-primary"]
     *
     * @param string\array $atts
     * @param string $content Content between start & end tag
     * @return string
     */
    public function obfuscateEmail($atts = [], string $content = null) : ?string
    {
        $a = shortcode_atts(
            [
                'class' => null,
                'address' => $content
            ],
            $atts
        );

        if (! is_email($a['address'])) {
            return null;
        }
        $class = $a['class'] ? sprintf(' class="%s"', $a['class']) : '';
        return sprintf('<a href="%s"%s>%s</a>', esc_url('mailto:' . antispambot($a['address'])), $class, esc_html(antispambot($a['address'])));
    }
}
