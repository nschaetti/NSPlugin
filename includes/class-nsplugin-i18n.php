<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link		http://www.nilsschaetti.com/
 * @since		1.0.0
 * @package		Nsplugin
 * @subpackage	Nsplugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since		1.0.0
 * @package		Nsplugin
 * @subpackage	Nsplugin/includes
 * @author		Nils Schaetti <n.schaetti@gmail.com>
 */
class Nsplugin_i18n 
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since	1.0.0
	 */
	public function load_plugin_textdomain() 
	{
		load_plugin_textdomain
		(
			'nsplugin',
			false,
			dirname(dirname(plugin_basename( __FILE__))) . '/languages/'
		);
	}

}
