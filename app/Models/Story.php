<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Models;

use Otomaties\WpModels\PostType;

if (! defined('ABSPATH')) {
    exit;
}

class Story extends PostType
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
