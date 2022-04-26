<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Social media settings
 */
class SocialMedia
{

    /**
     * Holds the values to be used in the fields callbacks
     *
     * @var array
     */
    private $options;

    /**
     * Add options page
     */
    public function addSettingsPage()
    {
        add_options_page(
            'Settings Admin',
            __('Social media', 'projectname-textdomain'),
			'edit_posts',
            'social-settings',
            [$this, 'createAdminPage']
        );
    }

    /**
     * Options page callback
     */
    public function createAdminPage()
    {
        $this->options = get_option('social');
        ?>

        <div class="wrap">
            <h1><?php __('Social Media', 'projectname-textdomain'); ?></h1>
            <form method="post" action="options.php">
            <?php
                settings_fields('social_option_group');
                do_settings_sections('social-settings');
                submit_button();
            ?>
            </form>
        </div>

        <?php
    }

    /**
     * Register and add settings
     */
    public function settingsPageContent()
    {
        apply_filters(
            'projectname_social_media_channels',
            $social_media = [
                'facebook'      => 'Facebook',
                'twitter'       => 'Twitter',
                'instagram'     => 'Instagram',
                'pinterest'     => 'Pinterest',
                'linkedin'      => 'Linkedin',
                'youtube'       => 'Youtube',
            ]
        );

        register_setting(
            'social_option_group',
            'social',
            [$this, 'sanitizeUrls']
        );

        add_settings_section(
            'setting_section_id',
            __('Social Media URL\'s', 'projectname-textdomain'),
            [$this, 'printSectionInfo'],
            'social-settings'
        );

        foreach ($social_media as $slug => $name) {
            add_settings_field(
                $slug,
                $name,
                [$this, 'socialCallback'],
                'social-settings',
                'setting_section_id',
                $args = [
                    'slug' => $slug,
                    'name' => $name,
                ]
            );
        }
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys.
     */
    public function sanitizeUrls($input)
    {
        return array_map (function ($url) {
            return esc_url($url);
        }, $input);
    }

    /**
     * Print the Section text
     */
    public function printSectionInfo()
    {
        esc_html_e('Enter your social media url\'s below:', 'projectname-textdomain');
    }

    /**
     * Get the settings option array and print one of its values
     *
     * @param array $args The arguments.
     */
    public function socialCallback($args)
    {
        printf(
            '<input type="text" class="regular-text" id="title" name="social[%s]" value="%s" />',
            $args['slug'],
            isset($this->options[$args['slug']]) ? esc_attr($this->options[$args['slug']]) : ''
        );
    }
}
