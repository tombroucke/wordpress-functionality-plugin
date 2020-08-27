<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Social media settings
 */
class Social_Media_Settings {

	/**
	 * Holds the values to be used in the fields callbacks
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Add options page
	 */
	public function add_settings_page() {
		add_options_page(
			'Settings Admin',
			__( 'Social media', 'projectname-textdomain' ),
			'manage_options',
			'social-settings',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {

		$this->options = get_option( 'social' );
		?>

		<div class="wrap">
			<h1><?php __( 'Social Media', 'projectname-textdomain' ); ?></h1>
			<form method="post" action="options.php">
			<?php
				settings_fields( 'social_option_group' );
				do_settings_sections( 'social-settings' );
				submit_button();
			?>
			</form>
		</div>

		<?php
	}

	/**
	 * Register and add settings
	 */
	public function settings_page_content() {
		apply_filters(
			'projectname_social_media_channels',
			$social_media = array(
				'facebook'      => 'Facebook',
				'twitter'       => 'Twitter',
				'instagram'     => 'Instagram',
				'pinterest'     => 'Pinterest',
				'linkedin'      => 'Linkedin',
				'youtube'       => 'Youtube',
			)
		);

		register_setting(
			'social_option_group',
			'social',
			array( $this, 'sanitize_urls' )
		);

		add_settings_section(
			'setting_section_id',
			__( 'Social Media URL\'s', 'projectname-textdomain' ),
			array( $this, 'print_section_info' ),
			'social-settings'
		);

		foreach ( $social_media as $slug => $name ) {
			add_settings_field(
				$slug,
				$name,
				array( $this, 'social_callback' ),
				'social-settings',
				'setting_section_id',
				$args = array(
					'slug' => $slug,
					'name' => $name,
				)
			);
		}
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys.
	 */
	public function sanitize_urls( $input ) {
		$new_input = array();

		foreach ( $input as $key => $value ) {
			$new_input[ $key ] = esc_url( $input[ $key ] );
		}

		return $new_input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info() {
		esc_html_e( 'Enter your social media url\'s below:', 'projectname-textdomain' );
	}

	/**
	 * Get the settings option array and print one of its values
	 *
	 * @param array $args The arguments.
	 */
	public function social_callback( $args ) {
		printf(
			'<input type="text" id="title" name="social[' . $args['slug'] . ']" value="%s" />',
			isset( $this->options[ $args['slug'] ] ) ? esc_attr( $this->options[ $args['slug'] ] ) : ''
		);
	}
}