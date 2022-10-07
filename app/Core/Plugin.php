<?php
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Our main plugin class
 */
class Plugin
{

    /**
     * Action and filter loader
     *
     * @var Loader
     */
    protected Loader $loader;

    /**
     * The plugin instance
     *
     * @var null|Plugin
     */
    private static $instance = null;

    /**
     * Get plugin instance
     *
     * @return Plugin
     */
    public static function instance()
    {
        if (! isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize plugin
     */
    public function __construct()
    {
        $this->loader = new Loader();
        $this->setLocale();

        $this->addSocialMedia();
        $this->addOptionsPage();
        $this->addShortcodes();
        $this->definePostTypeHooks();
        
        $this->defineAdminHooks();
        $this->defineFrontendHooks();
    }

    /**
     * Set locale
     *
     * @return void
     */
    private function setLocale() : void
    {
        (new I18n())->loadPluginTextdomain();
    }

    /**
     * Add Social media
     *
     * @return void
     */
    private function addSocialMedia() : void
    {
        $socialMedia = new SocialMedia();
        $this->loader->addAction('admin_menu', $socialMedia, 'addSettingsPage');
        $this->loader->addAction('admin_init', $socialMedia, 'settingsPageContent');
    }

    /**
     * Add shortcodes
     *
     * @return void
     */
    private function addShortcodes() : void
    {
        $shortcodes = new Shortcodes();
        // add_shortcode('foobar', [$shortcodes, 'foobarFunc']);
    }

    /**
     * Add options page
     *
     * @return void
     */
    private function addOptionsPage() : void
    {
        $options = new OptionsPage();
        $this->loader->addAction('acf/init', $options, 'addOptionsPage');
        $this->loader->addAction('acf/init', $options, 'addOptionsFields');
    }

    /**
     * Define custom post types
     *
     * @return void
     */
    private function definePostTypeHooks() : void
    {
        $cpts = new CustomPostTypes();
        // $this->loader->addAction('init', $cpts, 'addStories');
        // $this->loader->addAction('acf/init', $cpts, 'addStoryFields');
    }

    /**
     * Define frontend hooks
     *
     * @return void
     */
    private function defineFrontendHooks() : void
    {
        $frontend = new Frontend();
    }

    /**
     * Define admin hooks
     *
     * @return void
     */
    private function defineAdminHooks() : void
    {
        $admin = new Admin();
    }

    /**
     * Run actions and filters
     *
     * @return void
     */
    public function run() : void
    {
        $this->loader->run();
    }

    /**
     * Get loader
     *
     * @return Loader
     */
    public function getLoader() : Loader
    {
        return $this->loader;
    }
}
