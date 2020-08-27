<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * WordPress shortcodes
 */
class Shortcodes {

	/**
	 * Shortcode callback
	 *
	 * @param  array $atts The shortcut attributes.
	 * @return string
	 */
	public function foobar_func( $atts ) {

		$a = shortcode_atts(
			array(
				'foo' => 'something',
				'bar' => 'something else',
			),
			$atts
		);

		return "foo = {$a['foo']}";

	}

}
