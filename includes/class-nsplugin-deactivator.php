<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Nsplugin
 * @subpackage Nsplugin/includes
 * @author     Nils Schaetti <n.schaetti@gmail.com>
 */
class Nsplugin_Deactivator 
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() 
	{
		global $wpdb;
		
		// No foreign key checks
		$wpdb->query("SET FOREIGN_KEY_CHECKS=0;");
		
		// Get DB's table
		$tables = $wpdb->get_results("SHOW TABLES FROM {$wpdb->dbname};");
		
		// Property
		$prop = "Tables_in_" . $wpdb->dbname;
		
		// Foreach tables
		foreach($tables as $table)
		{
			$table_name = $table->$prop;
			if(strpos($table_name,$wpdb->prefix . "ns_") !== false)
			{
				$wpdb->query("DROP TABLE IF EXISTS {$table_name};");
			}
		}
	}

}
