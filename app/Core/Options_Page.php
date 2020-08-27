<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Add ACF options pages
 */
class Options_Page {

	/**
	 * Create pages
	 */
	public function add_options_page() {
		
		acf_add_options_page(
			array(
				'page_title'    => __( 'Projectname settings', 'projectname-textdomain' ),
				'menu_title'    => __( 'Projectname settings', 'projectname-textdomain' ),
				'menu_slug'     => 'projectname-settings',
				'capability'    => 'edit_posts',
				'redirect'      => false,
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'    => __( 'Projectname settings', 'projectname-textdomain' ),
				'menu_title' => __( 'Projectname settings', 'projectname-textdomain' ),
				'parent_slug'   => 'projectname-settings',
			)
		);
	}

}
