<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Abstracts;

/**
 * Logic for Sidewheels post types
 */
abstract class Post_Type {

	/**
	 * Post ID
	 *
	 * @var integer
	 */
	protected $ID;

	/**
	 * Post url
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * Post type
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * Define ID
	 *
	 * @param integer $id Post ID.
	 */
	public function __construct( $id ) {
		$this->ID = $id;
	}

	/**
	 * Returns the post ID
	 *
	 * @return integer Post ID
	 */
	public function get_ID() { //phpcs:ignore
		return $this->ID;
	}

	/**
	 * Get post meta
	 *
	 * @param  string  $key    The key to search for.
	 * @param  boolean $single Whether the or not to return a single meta value.
	 * @return string|boolean
	 */
	public function get( $key, $single = true ) {
		return get_post_meta( $this->get_ID(), $key, $single );
	}

	/**
	 * Get acf field
	 *
	 * @param  string $key    The key to search for.
	 * @param  string $prefix Prefix for the field.
	 * @return string|boolean
	 */
	public function get_field( $key, $prefix = '' ) {
		$key = $prefix ? $prefix . '_' . $key : $key;
		return get_field( $key, $this->get_ID() );
	}

	/**
	 * Set post meta
	 *
	 * @param integer $key   The meta key.
	 * @param string  $value The meta value.
	 * @return boolean
	 */
	public function set( $key, $value ) {
		return update_post_meta( $this->get_ID(), $key, $value );
	}

	/**
	 * Add post meta
	 *
	 * @param integer $key   The meta key.
	 * @param string  $value The meta value.
	 * @return boolean
	 */
	public function add_meta( $key, $value ) {
		return add_post_meta( $this->get_ID(), $key, $value );
	}

	/**
	 * Remove post meta
	 *
	 * @param integer     $key   The meta key.
	 * @param string|null $value The meta value.
	 * @return void
	 */
	public function remove_meta( $key, $value = null ) {
		if ( $value ) {
			delete_post_meta( $this->get_ID(), $key, $value );
		} else {
			delete_post_meta( $this->get_ID(), $key );
		}
	}

	/**
	 * Get post type
	 *
	 * @return string
	 */
	public function get_post_type() {
		return $this->post_type;
	}

	/**
	 * Get post title
	 *
	 * @return string
	 */
	public function get_title() {
		return get_the_title( $this->get_ID() );
	}

	/**
	 * Get post content
	 *
	 * @return string
	 */
	public function get_content() {
		$post_object = get_post( $this->get_ID() );
		return $post_object->post_content;
	}

	/**
	 * Get post url
	 *
	 * @return string
	 */
	public function get_url() {
		return get_the_permalink( $this->get_ID() );
	}

	/**
	 * Set property
	 *
	 * @param string $name  Name of the property.
	 * @param string $value New property value.
	 */
	public function __set( $name, $value ) {
		$this->$name = $value;
	}

	/**
	 * Find posts of post type
	 *
	 * @param array   $args Extra argument to find posts (wp_query args).
	 * @param integer $limit The number of posts to find.
	 * @param integer $paged Page number if paged.
	 * @return void
	 */
	public static function find( $args = array(), $limit = -1, $paged = 0 ) {
		$class    = get_called_class();
		$defaults = array(
			'post_type'      => static::post_type(),
			'posts_per_page' => $limit,
			'paged'          => $paged,
		);
		$args     = wp_parse_args( $args, $defaults );

		// Shouldn't be overridden.
		$args['fields'] = 'ids';

		$post_ids = get_posts( $args );
		return array_map(
			function( $post_id ) use ( $class ) {
				return new $class( $post_id );
			},
			$post_ids
		);

	}

	/**
	 * Find one post
	 *
	 * @param array   $args Extra argument to find posts (wp_query args).
	 * @return void
	 */
	public static function find_one( $args = array() ) {

		$args['posts_per_page'] = 1;
		$result                 = self::find( $args );
		if ( empty( $result ) ) {
			return false;
		}
		return $result[0];

	}
}
