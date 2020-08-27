<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality;

/**
 * Fetch all social media urls and icons
 *
 * @return array List of all social media
 */
function social_media() {
	$return = array();
	$social = get_option( 'social' );
	$social_media_map = array(
		'facebook' => array(
			'title' => 'Facebook',
			'icon' => 'fa-facebook-square',
		),
		'twitter' => array(
			'title' => 'Twitter',
			'icon' => 'fa-twitter',
		),
		'instagram' => array(
			'title' => 'Instagram',
			'icon' => 'fa-instagram',
		),
		'pinterest' => array(
			'title' => 'Pinterest',
			'icon' => 'fa-pinterest',
		),
		'linkedin' => array(
			'title' => 'Linkedin',
			'icon' => 'fa-linkedin',
		),
		'youtube' => array(
			'title' => 'YouTube',
			'icon' => 'fa-youtube',
		),
	);
	if ( $social && ! empty( $social ) ) {
		foreach ( $social as $key => $link ) {
			if ( $link ) {
				$item = array(
					'link' => $link,
					'icon' => $social_media_map[ $key ]['icon'],
				);
				array_push( $return, $item );
			}
		}
	}
	return apply_filters( 'projectname_social_media_values', $return );
}
