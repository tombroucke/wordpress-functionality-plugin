<?php
namespace ProjectnameNamespace\Functionality;

/**
 * Get defined social media with icons
 *
 * @return array<array<string, string>>
 */
function socialMedia() : array
{
    $social  = get_option('projectname_social_media');
    if (!$social || count($social) === 0) {
        return [];
    }

    $return = [];
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
        'tiktok'   => [
            'title' => __('TikTok', 'projectname-textdomain'),
            'icon'  => 'tiktok',
        ],
        'tripadvisor'   => [
            'title' => __('Tripadvisor', 'projectname-textdomain'),
            'icon'  => 'tripadvisor',
        ],
    ];
    if (!$social || count($social) > 0) {
        return [];
    }
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
    return apply_filters('projectname_social_media_values', $return);
}
