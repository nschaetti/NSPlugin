<?php

/**
 * Interface for hobbies object.
 * 
 * @file class-nsplugin-hobbies.php
 * @brief Class Nsplugin_Hobbies is an interface for hobbies DB object.
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Load abstract class
require_once('class-nsplugin-db-object.php');

/**
 * @class	Nsplugin_Hobbies
 * @brief	This class is an interface with hobby DB data.
 */
class Nsplugin_Hobbies extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_hobbies";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "hobby_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "hobby_id",			"type" => DB_TYPE_NUM),
											array("name" => "hobby_name",		"type" => DB_TYPE_STRING),
											array("name" => "hobby_post_id",	"type" => DB_TYPE_PAGE));
	
	/************************************************
	 ***************** Functions ********************
	 ************************************************/
	
	/**
	 * @func	get_id
	 * @brief	Get record's ID
	 * @return	Field's ID.
	 */
	public function get_id()
	{
		return $this->get_value(self::$m_sIDField);
	}
	
	/**
	 * @func	get_name
	 * @brief	Get hobby's name.
	 * @return	Hobby's name.
	 */
	public function get_name()
	{
		return $this->get_value('hobby_name');
	}
	
	/**
	 * @func	get_image
	 * @brief	Get hobby's image.
	 * @return	Hobby's image (WP_Post).
	 */
	public function get_image()
	{
		return $this->get_value('hobby_post_id');
	}
	
	/**
	 * @func	get_hobby
	 * @brief	Get a hobby object by its ID.
	 * @param	int $id Hobby's ID.
	 * @return	A hobby's object.
	 */
	static function get_hobby($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_hobbies
	 * @brief	Get all hobby object from the database.
	 * @return	An array with all hobby objects from the database.
	 */
	static function get_hobbies()
	{
		return self::get_records("hobby_id","asc");
	}
	
}
