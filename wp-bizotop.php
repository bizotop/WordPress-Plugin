<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name: Bizotop
 * Description: This wordpress plugin helps you to use Bizotop capabilities on your blog.
 * Version: 0.1.0
 * Author: Raya Navid Samaneh
 * Author URI: http://rns.ir/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: bizotop
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 0.1.0 and use SemVer - https://semver.org
 */
define('BIZOTOP_VERSION', '0.1.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bizotop-activator.php
 */
function activate_bizotop()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-bizotop-activator.php';
    Bizotop_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bizotop-deactivator.php
 */
function deactivate_bizotop()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-bizotop-deactivator.php';
    Bizotop_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_bizotop');
register_deactivation_hook(__FILE__, 'deactivate_bizotop');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-bizotop.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function run_bizotop()
{
    $plugin = new Bizotop();
    $plugin->run();
}
run_bizotop();
