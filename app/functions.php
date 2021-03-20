<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality;

/**
 * Fetch all social media urls and icons
 *
 * @return array List of all social media
 */
function social_media() {
	$return           = array();
	$social           = get_option( 'social' );
	$social_media_map = array(
		'facebook'  => array(
			'title' => __( 'Facebook', 'projectname-textdomain' ),
			'icon'  => 'facebook',
		),
		'twitter'   => array(
			'title' => __( 'Twitter', 'projectname-textdomain' ),
			'icon'  => 'twitter',
		),
		'instagram' => array(
			'title' => __( 'Instagram', 'projectname-textdomain' ),
			'icon'  => 'instagram',
		),
		'pinterest' => array(
			'title' => __( 'Pinterest', 'projectname-textdomain' ),
			'icon'  => 'pinterest',
		),
		'linkedin'  => array(
			'title' => __( 'Linkedin', 'projectname-textdomain' ),
			'icon'  => 'linkedin',
		),
		'youtube'   => array(
			'title' => __( 'YouTube', 'projectname-textdomain' ),
			'icon'  => 'youtube',
		),
	);
	if ( $social && ! empty( $social ) ) {
		foreach ( $social as $key => $link ) {
			if ( $link ) {
				$icon = $social_media_map[ $key ]['icon'];
				$icon = apply_filters( 'projectname_social_media_icon', $icon );
				$icon = apply_filters( 'projectname_social_media_icon' . $icon, $icon );
				$item = array(
					'title' => $social_media_map[ $key ]['title'],
					'link'  => $link,
					'icon'  => apply_filters( 'projectname_social_media_icon', $icon ),
				);
				array_push( $return, $item );
			}
		}
	}
	return apply_filters( 'projectname_social_media_values', $return );
}
