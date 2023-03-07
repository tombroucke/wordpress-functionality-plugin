<?php
/**
 * Plugin Name: Projectname functionality
 * Description: Functionality plugin for Projectname
 * Author: Tom Broucke
 * Author URI: https://tombroucke.be
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: projectname-textdomain
 * Domain Path: languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once realpath(__DIR__ . '/vendor/autoload.php');
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
add_action(
    'plugins_loaded',
    function () {
        $plugin = ProjectnameNamespace\Functionality\Core\Plugin::instance();
        $plugin->run();
    }
);
