<?php
namespace ProjectnameNamespace\Functionality\Core;

/**
 * Allow mu-plugin strings to be translated
 */
class I18n
{
    
    /**
     * Load must use plugin textdomain
     *
     * @return void
     */
    public function loadPluginTextdomain() : void
    {
        load_muplugin_textdomain('projectname-textdomain', dirname(plugin_basename(__FILE__), 3) . '/languages/');
    }
}
