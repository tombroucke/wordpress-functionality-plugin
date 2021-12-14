<?php //phpcs:ignore
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Allow mu-plugin strings to be translated
 */
class i18n { //phpcs:ignore

    /**
     * Load must use plugin textdomain
     *
     * @return void
     */
    public function loadPluginTextdomain()
    {
        load_muplugin_textdomain('projectname-textdomain', dirname(plugin_basename(__FILE__), 2) . '/languages/');
    }
}
