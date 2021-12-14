<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Abstracts;

abstract class Post
{
    /**
     * Post ID
     *
     * @var integer
     */
    protected $ID;

    /**
     * Initialize post type
     *
     * @param integer $id Post ID.
     */
    public function __construct(int $id)
    {
        $this->ID = $id;
        $this->validatePostType();
    }

    /**
     * Returns the post ID
     *
     * @return integer Post ID
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * Validate if post id matches postType
     *
     * @return void
     */
    public function validatePostType()
    {
        if (get_post_type($this->getId()) != $this->postType()) {
            // TODO: Implement a better way to display an error message. 404?
            die(sprintf('<code>%s is not a valid %s ID</code>', $this->getId(), $this->postType()));
        }
    }

    /**
     * Get post type
     *
     * @return string
     */
    abstract public static function postType() : string;

    /**
     * Get post meta
     *
     * @param  string  $key    The meta key.
     * @param  boolean $single Whether the result is a single record or an array of records.
     * @return mixed           An array of values if $single is false. The value of the meta field if $single is true. False for an invalid $post_id (non-numeric, zero, or negative value). An empty string if a valid but non-existing post ID is passed.
     */
    public function get(string $key, bool $single = true)
    {
        return get_post_meta($this->getId(), $key, $single);
    }

    /**
     * Get acf field
     *
     * @param  string $key The meta key.
     * @return mixed       The meta value for given key.
     */
    public function getField($key)
    {
        if (function_exists('get_field')) {
            return get_field($key, $this->getId());
        }
        return false;
    }

    /**
     * Get date created
     *
     * @param string $format
     * @return void
     */
    public function date(string $format = '') : ?string
    {
        return get_the_date($format, $this->getId());
    }

    /**
     * Set post meta
     *
     * @param string $key The meta key.
     * @param string $value The meta value.
     * @return integer\boolean Meta ID if the key didn't exist, true on successful update, false on failure or if the value passed to the function is the same as the one that is already in the database.
     */
    public function set(string $key, string $value)
    {
        return update_post_meta($this->getId(), $key, $value);
    }

    /**
     * Add post meta
     *
     * @param string $key The meta key.
     * @param string  $value The meta value.
     * @return integer\boolean Meta ID on success, false on failure.
     */
    public function addMeta(string $key, string $value)
    {
        return add_post_meta($this->getId(), $key, $value);
    }

    /**
     * Remove post meta
     *
     * @param string     $key    The meta key.
     * @param string|null $value  The meta value.
     * @return boolean            Whether the meta has been removed.
     */
    public function removeMeta(string $key, string $value = null) : bool
    {
        if ($value) {
            return delete_post_meta($this->getId(), $key, $value);
        }
        return delete_post_meta($this->getId(), $key);
    }

    /**
     * Get post title
     *
     * @return string The post title.
     */
    public function title() : string
    {
        return get_the_title($this->getId());
    }

    /**
     * Get post content
     *
     * @return string The post content.
     */
    public function content() : string
    {
        $post_object = get_post($this->getId());
        return $post_object->post_content;
    }

    /**
     * Get post name
     *
     * @return string The post slug.
     */
    public function name() : string
    {
        $post_object = get_post($this->getId());
        return $post_object->post_name;
    }

    /**
     * Get post url
     *
     * @return string The permalink.
     */
    public function url() : string
    {
        return get_the_permalink($this->getId());
    }

    /**
     * Get post author
     *
     * @return int
     */
    public function author() : int
    {
        return get_post_field('post_author', $this->getId());
    }

    /**
     * Query posts
     *
     * @param array $args
     * @param integer $limit
     * @param integer $paged
     * @return array
     */
    public static function find(array $args = [], int $limit = -1, int $paged = 0) : array
    {
        $class = get_called_class();
        $defaults = array(
            'post_type' => static::postType(),
            'posts_per_page' => $limit,
            'paged' => $paged
        );
        $args = wp_parse_args($args, $defaults);
        
        // Shouldn't be overridden.
        $args['fields'] = 'ids';

        $post_ids = get_posts($args);
        return array_map(
            function ($post_id) use ($class) {
                return new $class($post_id);
            },
            $post_ids
        );
    }

    /**
     * Insert new post
     *
     * @param array $args
     * @return mixed
     */
    public static function insert(array $args)
    {
        $class = get_called_class();
        $defaults = array(
            'post_type' => static::postType(),
            'post_status' => 'publish',
            'post_title' => '',
            'post_content' => '',
        );

        $args = wp_parse_args($args, $defaults);
        $post_id = wp_insert_post($args);

        return new $class($post_id);
    }
}
