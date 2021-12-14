<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Models;

use ProjectnameNamespace\Functionality\Abstracts\Post;

if (! defined('ABSPATH')) {
    exit;
}

class Story extends Post
{

    /**
     * Construct parent
     * @param int $id post_id
     */
    public function __construct($id)
    {
        parent::__construct($id);
    }

    public static function postType() : string
    {
        return 'story';
    }
}
