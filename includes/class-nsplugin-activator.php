<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/includes
 */

// Get database object
global $wpdb ;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Nsplugin
 * @subpackage Nsplugin/includes
 * @author     Nils Schaetti <n.schaetti@gmail.com>
 */
class Nsplugin_Activator 
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() 
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
		
		// Read DB file
		$db_file_content = file_get_contents("../wp-content/plugins/nsplugin/db/create_database.sql");
		
		// Separate by ;
		$queries = explode(';', $db_file_content);
		
		// Execute
		foreach($queries as $query)
		{
			if($query != "")
			{
				$wpdb->query($query);
			}
		}
	}

}
