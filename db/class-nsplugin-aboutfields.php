<?php

/**
 * Interface for about fields object.
 * 
 * @file class-nsplugin-aboutfields.php
 * @brief Class Nsplugin_About_Fields is an interface for about fields DB object.
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Load abstract class
require_once('class-nsplugin-db-object.php');

// Field's type
define('ABOUTFIELD_TYPE_STRING',		0);
define('ABOUTFIELD_TYPE_INT',			1);
define('ABOUTFIELD_TYPE_POSTID',		2);

/**
 * @class	Nsplugin_About_Fields
 * @brief	This class is an interface with about fields DB data.
 */
class Nsplugin_About_Fields extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_aboutfields";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "aboutfield_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "aboutfield_id",			"type" => DB_TYPE_NUM),
											array("name" => "aboutfield_position",		"type" => DB_TYPE_NUM),
											array("name" => "aboutfield_name",			"type" => DB_TYPE_STRING),
											array("name" => "aboutfield_type",			"type" => DB_TYPE_SELECT, "options" => array(
												"ABOUTFIELD_TYPE_STRING" =>		ABOUTFIELD_TYPE_STRING,
												"ABOUTFIELD_TYPE_INT" =>		ABOUTFIELD_TYPE_INT,
												"ABOUTFIELD_TYPE_POSTID" =>		ABOUTFIELD_TYPE_POSTID)),
											array("name" => "aboutfield_stringvalue",	"type" => DB_TYPE_STRING),
											array("name" => "aboutfield_intvalue",		"type" => DB_TYPE_NUM),
											array("name" => "aboutfield_post_id",		"type" => DB_TYPE_PAGE));
	
	/************************************************
	 ***************** Functions ********************
	 ************************************************/
	
	/**
	 * @func	get_id
	 * @brief	Get record's ID.
	 * @return	Field's ID.
	 */
	public function get_id()
	{
		return $this->get_value(self::$m_sIDField);
	}
	
	/**
	 * @func	get_position
	 * @brief	Get field's position, this position is unique.
	 * @return	The unique position of the field.
	 */
	public function get_position()
	{
		return $this->get_value('aboutfield_position');
	}

	/**
	 * @func	get_name
	 * @brief	Get field's name.
	 * @return	The field's name.
	 */
	public function get_name()
	{
		return $this->get_value('aboutfield_name');
	}
	
	/**
	 * @func	get_type
	 * @brief	Get field's type (ABOUTFIELD_TYPE_STRING, ABOUTFIELD_TYPE_INT, ABOUTFIELD_TYPE_POSTID). 
	 * @return	Field's type.
	 */
	public function get_type()
	{
		return $this->get_value('aboutfield_type');
	}

	/**
	 * @func	get_string_value
	 * @brief	Get field's string value.
	 * @return	Field's string value.
	 */
	public function get_string_value()
	{
		return $this->get_value('aboutfield_stringvalue');
	}

	/**
	 * @func	get_int_value
	 * @brief	Get field's int value.
	 * @return	Field's int value.
	 */
	public function get_int_value()
	{
		return $this->get_value('aboutfield_intvalue');
	}

	/**
	 * @func	get_page
	 * @brief	Get field's page value.
	 * @return	Field's page value.
	 */
	public function get_page()
	{
		return $this->get_value('aboutfield_post_id');
	}
	
	/**
	 * @func	get_image
	 * @brief	Get field's image value.
	 * @return	Field's image value.
	 */
	public function get_image()
	{
		return $this->get_value('aboutfield_post_id');
	}
	
	/**
	 * @func	get_aboutfield
	 * @brief	Get an about field by ID.
	 * @param	int $id Field's ID.
	 * @return	About field's object.
	 */
	static function get_aboutfield($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_aboutfields
	 * @brief	Get all about field objects from the database.
	 * @return	An array of about field objects.
	 */
	static function get_aboutfields()
	{
		return self::get_records("aboutfield_position","asc");
	}
	
	/**
	 * @func	get_field_value
	 * @brief	Get a about field's value
	 * @return	The field's value or null.
	 */
	static function get_field_value($name)
	{
		global $wpdb;
		
		$records = $wpdb->get_results("SELECT * FROM " . self::$m_sTable . " WHERE aboutfield_name LIKE '" . $name . "'");
		if(count($records) > 0)
		{
			switch($records[0]->aboutfield_type)
			{
				case "ABOUTFIELD_TYPE_INT":
					return $records[0]->aboutfield_intvalue;
					break;
				case "ABOUTFIELD_TYPE_POSTID":
					$image = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = " . $records[0]->aboutfield_post_id);
					return $image[0]->guid;
					break;
				case "ABOUTFIELD_TYPE_STRING":
					return $records[0]->aboutfield_stringvalue;
					break;
			}
		}
	}
	
}
