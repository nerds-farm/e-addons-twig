<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       e-addons TWIG
 * Plugin URI:        https://e-addons.com
 * Description:       Write dynamic texts anywhere without the need to know how to program
 * Version:           1.1
 * Author:            Nerds Farm
 * Author URI:        https://nerds.farm
 * Text Domain:       e-addons-twig
 * Domain Path:       /languages
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Free:              true
 *
 * @package e-addons
 * @category Twig
 *
 */
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Load Elements
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 0.1.0
 */
add_action('e_addons/loaded', function() {
    require_once( __DIR__.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'plugin.php' );
    $plugin = new \EAddonsTwig\Plugin();
});
add_action('plugins_loaded', function() {
    if (!function_exists('e_addons_load_plugin')) {
        add_action('admin_notices', function() {
            $message = __('You need to activate "Elementor Free" and "e-addons Free" in order to use "e-addons Twig" plugin.', 'elementor');
            echo '<div class="notice notice-error"><p>' . $message . '</p></div>';
        });
    }
}, 11);
