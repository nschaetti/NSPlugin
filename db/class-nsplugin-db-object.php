<?php

/**
 * Interface for all database objects.
 * 
 * @file class-nsplugin-db-object.php
 * @brief Class Nsplugin_Db_Object is an interface for all DB objects
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Field types
define('DB_TYPE_NUM',		0);
define('DB_TYPE_STRING',	1);
define('DB_TYPE_DATE',		2);
define('DB_TYPE_PAGE',		3);
define('DB_TYPE_TERM',		4);
define('DB_TYPE_SELECT',	5);
define('DB_TYPE_BOOLEAN',	6);

/**
 * @class	Nsplugin_List
 * @brief	List widget for admin menus
 */
abstract class Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable;
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField;
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	Description of the corresponding table.
	 */
	static public $m_aTableDesc;
	
	/**
	 * @var		$m_aFieldsValue
	 * @brief 	Value of each fields.
	 */
	protected $m_aFieldsValue;
	
	/************************************************
	 ***************** Functions ********************
	 ************************************************/
	
	/**
	 * @func	__construct
	 * @brief	Constructor
	 */
	function __construct($fields_value)
	{
		$this->m_aFieldsValue = $fields_value;
	}
	
	/**
	 * @func	get_value
	 * @brief 	Get the value of a field.
	 * @param	string $key The field's name.
	 * @return 	Field's value.
	 */
	public function get_value($key)
	{
		return	(isset($this->m_aFieldsValue[$key])) ? $this->m_aFieldsValue[$key] : null;
	}
	
	/**
	 * @func	set_value
	 * @brief 	Set the value of a field.
	 * @param 	string $key The field's name.
	 * @param 	$value Field's value.
	 */
	public function set_value($key, $value)
	{
		$this->m_aFieldsValue[$key] = $value;
	}
	
	/**
	 * @func	get_element_by_id
	 * @brief	Get an element by its ID
	 * @return 	The corresponding Nsplugin_Db_Object object.
	 */
	static function get_element_by_id($id)
	{
		global $wpdb;
		$fields_value = array();
		
		// Class name
		$class_name = get_called_class();
		
		// DB properties
		$table = $class_name::$m_sTable;
		$idfield = $class_name::$m_sIDField;
		
		// Get data
		$data = $wpdb->get_results("SELECT * FROM $table WHERE $idfield = $id");
		
		// There is results
		if(count($data) > 0)
		{
			return self::record_to_object($data[0], $class_name);
		}
		return null;
	}
	
	/**
	 * @func	record_to_object
	 * @brief	Transform a record to an object.
	 * @param	array $record The record to transform.
	 * @param	string $class_name The class' name to transform to.
	 * @return	An instance of $class_name corresponding to the record.
	 */
	static function record_to_object($record, $class_name)
	{
		$fields_value = array();
		
		// For each fields
		foreach($class_name::$m_aTableDesc as $field)
		{
			// Field's name
			$field_name = $field['name'];
			
			// Set
			if(isset($record->$field_name) && $record->$field_name != null)
			{
				// Type?
				switch($field['type'])
				{
					case DB_TYPE_NUM:
						$fields_value[$field_name] = intval($record->$field_name);
						break;
					case DB_TYPE_STRING:
						$fields_value[$field_name] = $record->$field_name;
						break;
					case DB_TYPE_DATE:
						$fields_value[$field_name] = DateTime::createFromFormat('Y-m-d', $record->$field_name);
						break;
					case DB_TYPE_PAGE:
						$fields_value[$field_name] = get_post($record->$field_name);
						break;
					case DB_TYPE_TERM:
						$fields_value[$field_name] = get_term($term = $record->$field_name);
						break;
					case DB_TYPE_SELECT:
						$fields_value[$field_name] = $field['options'][$record->$field_name];
						break;
					case DB_TYPE_BOOLEAN:
						$fields_value[$field_name] = boolval($record->$field_name);
						break;
				}
			}
		}
		
		// Return new instance
		return new $class_name($fields_value);
	}
	
	/**
	 * @func	get_records
	 * @brief	Get all records from the table
	 * @param 	string $order_field Field's name to order by.
	 * @param 	string $order Ascending or descending orde (asc,desc).
	 * return 	An array of objects.
	 */
	static function get_records($order_field = "", $order = "asc", $limit = -1)
	{
		global $wpdb;
		$objects = array();
		
		// Class name
		$class_name = get_called_class();
		
		// DB properties
		$table = $class_name::$m_sTable;
		
		// Limit
		if($limit != -1)
			$limit_to = "LIMIT " . $limit;
		$limit_to = ($limit == -1) ? "" : " LIMIT " . $limit;
		
		// Get data
		if($order_field != "")
			$records = $wpdb->get_results("SELECT * FROM $table ORDER BY $order_field $order" . $limit_to);
		else
			$records = $wpdb->get_results("SELECT * FROM $table" . $limit_to);
		
		// Foreach record
		foreach($records as $record)
		{
			$object = self::record_to_object($record, $class_name);
			array_push($objects, $object);
		}
		
		return $objects;
	}
	
	/**
	 * @func	update_record
	 * @brief	Update a record
	 */
	public function update_record()
	{
	}
	
	/**
	 * @func	insert_record
	 * @brief	Insert a record
	 */
	public function insert_record()
	{
	}
	
}
