<?php

/**
 * Interface for traits object.
 * 
 * @file class-nsplugin-traits.php
 * @brief Class Nsplugin_Traits is an interface for personal trait DB object.
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
 * @class	Nsplugin_Traits
 * @brief	Class Nsplugin_Traits is an interface for traits objects in the DB.
 */
class Nsplugin_Traits extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_traits";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "trait_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "trait_id",			"type" => DB_TYPE_NUM),
											array("name" => "trait_position",	"type" => DB_TYPE_NUM),
											array("name" => "trait_name",		"type" => DB_TYPE_STRING),
											array("name" => "trait_post_id",	"type" => DB_TYPE_PAGE),
											array("name" => "trait_desc",		"type" => DB_TYPE_STRING));
	
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
	 * @func	get_position
	 * @brief	Get trait's position.
	 * @return 	Trait's position as an integer.
	 */
	public function get_position()
	{
		return $this->get_value('trait_position');
	}
	
	/**
	 * @func	get_name
	 * @brief	Get trait's name.
	 * @return 	Trait's name as a string.
	 */
	public function get_name()
	{
		return $this->get_value('trait_name');
	}

	/**
	 * @func	get_image
	 * @brief	Get trait's image.
	 * @return 	Trait's image as a WP_Post.
	 */
	public function get_image()
	{
		return $this->get_desc('trait_post_id');
	}

	/**
	 * @func	get_desc
	 * @brief	Get trait's description.
	 * @return 	Trait's description as a string.
	 */
	public function get_desc()
	{
		return $this->get_value('trait_desc');
	}
	
	/**
	 * @func	get_trait
	 * @brief 	Get a trait object by its ID.
	 * @param 	int $id Trait's ID to get.
	 * @return 	A Nsplugin_Traits object.
	 */
	static function get_trait($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_traits
	 * @brief 	Get all Nsplugin_Traits object from the database.
	 * @return 	An array of Nsplugin_Traits object.
	 */
	static function get_traits()
	{
		return self::get_records("trait_position","asc");
	}
	
}
