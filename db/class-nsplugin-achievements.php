<?php

/**
 * Interface for achievements object.
 * 
 * @file class-nsplugin-achievements.php
 * @brief Class Nsplugin_Achievements is an interface for achievements DB objects.
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
 * @class	Nsplugin_Achievements
 * @brief	This class is an interface with achievements DB data.
 */
class Nsplugin_Achievements extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_achievements";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "achv_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "achv_id",			"type" => DB_TYPE_NUM),
											array("name" => "achv_position",	"type" => DB_TYPE_NUM),
											array("name" => "achv_abbr",		"type" => DB_TYPE_STRING),
											array("name" => "achv_desc",		"type" => DB_TYPE_STRING),
											array("name" => "achv_post_id",		"type" => DB_TYPE_PAGE));
	
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
	 * @brief	Get achievement's position (this column is unique).
	 * @return	Achievement's position.
	 */
	public function get_position()
	{
		return $this->get_value('achv_position');
	}
	
	/**
	 * @func	get_abbr
	 * @brief	Get achievement's abbreviation.
	 * @return	Achievement's abbreviation.
	 */
	public function get_abbr()
	{
		return $this->get_value('achv_abbr');
	}

	/**
	 * @func	get_desc
	 * @brief	Get achievement's description.
	 * @return	Achievement's description.
	 */
	public function get_desc()
	{
		return $this->get_value('achv_desc');
	}
	
	/**
	 * @func	get_achievement
	 * @brief	Get an achievement object by ID.
	 * @param	int $id Achievement's ID to load.
	 * @return	Achievement object or null.
	 */
	static function get_achievement($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_achievements
	 * @brief	Get all achievement objects in the database.
	 * @return	All achievement objects in the database or an empty array.
	 */
	static function get_achievements()
	{
		return self::get_records("achv_position","asc");
	}
	
}
