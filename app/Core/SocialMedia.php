<?php
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Social media settings
 */
class SocialMedia
{

    /**
     * Holds the values to be used in the fields callbacks
     *
     * @var array<string, string>
     */
    private $options;

    public function __construct()
    {
        $this->options = get_option('projectname_social_media');
    }

    /**
     * Add settings page
     *
     * @return void
     */
    public function addSettingsPage() : void
    {
        add_options_page(
            'Settings Admin',
            __('Social media', 'projectname-textdomain'),
            'edit_posts',
            'projectname-social-media',
            [$this, 'renderSocialMediaPage']
        );
    }

    /**
     * Social media callback
     *
     * @return void
     */
    public function renderSocialMediaPage() : void
    {
        ?>
        <div class="wrap">
            <h1><?php __('Social Media', 'projectname-textdomain'); ?></h1>
            <form method="post" action="options.php">
            <?php
                settings_fields('projectname_social_media_option_group');
                do_settings_sections('projectname-social-media');
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register options and add settings
     *
     * @return void
     */
    public function settingsPageContent() : void
    {
        apply_filters(
            'projectname_social_media_channels',
            $social_media = [
                'facebook'      => 'Facebook',
                'instagram'     => 'Instagram',
                'linkedin'      => 'Linkedin',
                'pinterest'     => 'Pinterest',
                'tiktok'        => 'TikTok',
                'tripadvisor'   => 'Tripadvisor',
                'twitter'       => 'Twitter',
                'youtube'       => 'Youtube',
            ]
        );

        register_setting(
            'projectname_social_media_option_group',
            'projectname_social_media',
            [$this, 'sanitizeUrls']
        );

        add_settings_section(
            'projectname_social_media_urls',
            __('Social Media URL\'s', 'projectname-textdomain'),
            [$this, 'printSectionInfo'],
            'projectname-social-media'
        );

        foreach ($social_media as $slug => $name) {
            add_settings_field(
                $slug,
                $name,
                [$this, 'socialMediaCallback'],
                'projectname-social-media',
                'projectname_social_media_urls',
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
     * @param array<string, string> $input Contains all settings fields as array keys.
     * @return array<string, string>
     */
    public function sanitizeUrls(array $input) : array
    {
        return array_map(function ($url) {
            return str_replace('http://', 'https://', esc_url($url));
        }, $input);
    }

    /**
     * Print the Section text
     *
     * @return void
     */
    public function printSectionInfo() : void
    {
        esc_html_e('Enter your social media url\'s below:', 'projectname-textdomain');
    }

    /**
     * Get the settings option array and print one of its values
     *
     * @param array<string, string> $args The arguments.
     * @return void
     */
    public function socialMediaCallback(array $args) : void
    {
        printf(
            '<input type="text" class="regular-text" id="title" name="projectname_social_media[%s]" value="%s" />',
            $args['slug'],
            isset($this->options[$args['slug']]) ? esc_attr($this->options[$args['slug']]) : ''
        );
    }
}
