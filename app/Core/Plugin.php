<?php //phpcs:ignore
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
    protected $loader;

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
     */
    private function setLocale()
    {
        $plugin_i18n = new i18n();
        $plugin_i18n->loadPluginTextdomain();
    }

    private function addSocialMedia()
    {
        $socialMedia = new SocialMedia();
        $this->loader->addAction('admin_menu', $socialMedia, 'addSettingsPage');
        $this->loader->addAction('admin_init', $socialMedia, 'settingsPageContent');
    }

    private function addShortcodes()
    {
        $shortcodes = new Shortcodes();
        add_shortcode('foobar', [$shortcodes, 'foobarFunc']);
    }

    private function addOptionsPage()
    {
        $options = new OptionsPage();
        $this->loader->addAction('acf/init', $options, 'addOptionsPage');
        $this->loader->addAction('acf/init', $options, 'addOptionsFields');
    }

    private function definePostTypeHooks()
    {
        $cpts = new CustomPostTypes();
        // $this->loader->addAction('init', $cpts, 'addStories');
        // $this->loader->addAction('acf/init', $cpts, 'addStoryFields');
    }

    private function defineFrontendHooks()
    {
        $frontend = new Frontend();
    }

    private function defineAdminHooks()
    {
        $admin = new Admin();
    }

    /**
     * Run actions and filters
     *
     * @return void
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * Get loader
     *
     * @return Loader
     */
    public function getLoader()
    {
        return $this->loader;
    }
}
