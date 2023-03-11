<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://webtechsofts.com/
 * @since             1.0.0
 * @package           Products_Orders_Export
 *
 * @wordpress-plugin
 * Plugin Name:       Products & Orders Export
 * Plugin URI:        https://#
 * Description:       Export All Product & Order Details 
 * Version:           1.0.0
 * Author:            Web Tech Softs
 * Author URI:        https://https://webtechsofts.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       products-orders-export
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
define( 'PRODUCTS_ORDERS_EXPORT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-products-orders-export-activator.php
 */
function activate_products_orders_export() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-orders-export-activator.php';
	Products_Orders_Export_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-products-orders-export-deactivator.php
 */
function deactivate_products_orders_export() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-orders-export-deactivator.php';
	Products_Orders_Export_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_products_orders_export' );
register_deactivation_hook( __FILE__, 'deactivate_products_orders_export' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-products-orders-export.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_products_orders_export() {

	$plugin = new Products_Orders_Export();
	$plugin->run();

}
run_products_orders_export();
