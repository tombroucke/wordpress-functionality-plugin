<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Allow mu-plugin strings to be translated
 */
class i18n { //phpcs:ignore

	/**
	 * Load must use plugin textdomain
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() {

		load_muplugin_textdomain( 'projectname-textdomain', dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );

	}

}
