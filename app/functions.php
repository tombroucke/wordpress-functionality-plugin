<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality;

/**
 * Fetch all social media urls and icons
 *
 * @return array List of all social media
 */
function socialMedia()
{
    $return           = [];
    $social           = get_option('social');
    $socialMediaMap = [
        'facebook'  => [
            'title' => __('Facebook', 'projectname-textdomain'),
            'icon'  => 'facebook',
        ],
        'twitter'   => [
            'title' => __('Twitter', 'projectname-textdomain'),
            'icon'  => 'twitter',
        ],
        'instagram' => [
            'title' => __('Instagram', 'projectname-textdomain'),
            'icon'  => 'instagram',
        ],
        'pinterest' => [
            'title' => __('Pinterest', 'projectname-textdomain'),
            'icon'  => 'pinterest',
        ],
        'linkedin'  => [
            'title' => __('Linkedin', 'projectname-textdomain'),
            'icon'  => 'linkedin',
        ],
        'youtube'   => [
            'title' => __('YouTube', 'projectname-textdomain'),
            'icon'  => 'youtube',
        ],
    ];
    if ($social && ! empty($social)) {
        foreach ($social as $key => $link) {
            if ($link) {
                $icon = $socialMediaMap[ $key ]['icon'];
                $icon = apply_filters('projectname_social_media_icon', $icon);
                $icon = apply_filters('projectname_social_media_icon' . $icon, $icon);
                $item = [
                    'title' => $socialMediaMap[$key]['title'],
                    'link'  => $link,
                    'icon'  => apply_filters('projectname_social_media_icon', $icon),
                ];
                array_push($return, $item);
            }
        }
    }
    return apply_filters('projectname_social_media_values', $return);
}
