<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.nilsschaetti.com/
 * @since             1.0.0
 * @package           Nsplugin
 *
 * @wordpress-plugin
 * Plugin Name:       NSPlugin
 * Plugin URI:        http://www.nilsschaetti.com/index.php/projects/nsplugin
 * Description:       Plugin for the website nilsschaetti.com.
 * Version:           1.0.0
 * Author:            Nils Schaetti
 * Author URI:        http://www.nilsschaetti.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nsplugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) 
{
	die;
}

/****************************************************
 **************** BEGIN FUNCTIONS *******************
 ****************************************************/

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nsplugin-activator.php
 */
function activate_nsplugin() 
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nsplugin-activator.php';
	Nsplugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nsplugin-deactivator.php
 */
function deactivate_nsplugin() 
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nsplugin-deactivator.php';
	Nsplugin_Deactivator::deactivate();
}

/**
 * Register a widget
 */
function register_nswidget()
{
	require_once plugin_dir_path( __FILE__ ) . 'widgets/nssociallinks.php';
	register_widget('NsWidget');
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
function run_nsplugin() 
{
	$plugin = new Nsplugin();
	$plugin->run();
}

/****************************************************
 ****************** END FUNCTIONS *******************
 ****************************************************/

// Hook to activate the plugin
register_activation_hook( __FILE__, 'activate_nsplugin' );

// Hook to deactivate the plugin
register_deactivation_hook( __FILE__, 'deactivate_nsplugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nsplugin.php';

// Hook to initialize the widget
add_action('widgets_init', 'register_nswidget');

// Run the plugin
run_nsplugin();
