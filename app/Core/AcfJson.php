<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Store ACF fields in json file
 */
class AcfJson {

	/**
	 * The path to our json directory
	 *
	 * @var string
	 */
	private $path;

	/**
	 * Define path and add actions
	 */
	public function __construct() {
		$this->path = dirname( dirname( plugin_dir_path( __FILE__ ) ) ) . '/acf-json';
	}

	/**
	 * Set custom directory when saving json
	 *
	 * @param  string $path The default path.
	 * @return string       The custom path
	 */
	public function save_json( $path ) {

		if ( ! is_dir( $this->path ) ) {
			mkdir( $this->path );
		}
		return $this->path;

	}

	/**
	 * Make acf search our custom directory when loading json files
	 *
	 * @param  array $paths The array of paths to seach in.
	 * @return array        The modified array of paths
	 */
	public function load_json( $paths ) {

		$paths[] = $this->path;
		return $paths;

	}

}
