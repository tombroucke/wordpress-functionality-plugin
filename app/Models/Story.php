<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Models;

use ProjectnameNamespace\Functionality\Abstracts\Post_Type;

if ( ! defined( 'ABSPATH' ) ) exit;

class Story extends Post_Type {

	/**
	 * Construct parent
	 * @param int $id post_id
	 */
	public function __construct( $id ) {
		parent::__construct( $id );
	}
}