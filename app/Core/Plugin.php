<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

use ProjectnameNamespace\Functionality\Hooks\Admin;
use ProjectnameNamespace\Functionality\Hooks\Frontend;

use ProjectnameNamespace\Functionality\Models\Story;

/**
 * Our main plugin class
 */
class Plugin {

	/**
	 * Action and filter loader
	 *
	 * @var Loader
	 */
	protected $loader;

	/**
	 * The plugin instance
	 *
	 * @var null|Plugin
	 */
	private static $_instance = null;

	/**
	 * Get plugin instance
	 *
	 * @return Plugin
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize plugin
	 */
	public function __construct() {

		$this->loader = new Loader();
		$this->set_locale();
		$this->define_hooks();

	}

	/**
	 * Set local
	 */
	private function set_locale() {

		$plugin_i18n = new i18n();
		$plugin_i18n->load_plugin_textdomain();

	}

	/**
	 * Define hooks
	 *
	 * @return void
	 */
	private function define_hooks() {

		$acf_json = new ACF_Json();
		$this->loader->add_filter( 'acf/settings/save_json', $acf_json, 'save_json' );
		$this->loader->add_filter( 'acf/settings/load_json', $acf_json, 'load_json' );

		$cpts = new Custom_Post_Types();
		$this->loader->add_action( 'init', $cpts, 'add_stories' );

		$options = new Options_Page();
		$this->loader->add_action( 'acf/init', $options, 'add_options_page' );

		$shortcodes = new Shortcodes();
		add_shortcode( 'foobar', array( $shortcodes, 'foobar_func' ) );

		$social_media = new Social_Media_Settings();
		$this->loader->add_action( 'admin_menu', $social_media, 'add_settings_page' );
		$this->loader->add_action( 'admin_init', $social_media, 'settings_page_content' );

		$admin = new Admin();
		$public = new Frontend();
	}

	/**
	 * Run actions and filters
	 *
	 * @return void
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * Get loader
	 *
	 * @return Loader
	 */
	public function get_loader() {
		return $this->loader;
	}

}
