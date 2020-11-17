<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.indexld.com
 * @since             1.0.0
 * @package           Indexld
 *
 * @wordpress-plugin
 * Plugin Name:       indexld
 * Plugin URI:        indexld
 * Description:       plugin de gestion des formations.
 * Version:           1.0.0
 * Author:            indexld
 * Author URI:        www.indexld.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       indexld
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'INDEXLD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-indexld-activator.php
 */
function activate_indexld() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-indexld-activator.php';
	Indexld_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-indexld-deactivator.php
 */
function deactivate_indexld() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-indexld-deactivator.php';
	Indexld_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_indexld' );
register_deactivation_hook( __FILE__, 'deactivate_indexld' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-indexld.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_indexld() {

	$plugin = new Indexld();
	$plugin->run();

}
run_indexld();
