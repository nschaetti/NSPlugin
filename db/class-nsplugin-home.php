<?php

/**
 * Interface for home page object.
 * 
 * @file class-nsplugin-home.php
 * @brief Class Nsplugin_Home is an interface for home page DB object.
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Load abstract class
require_once('class-nsplugin-db-object.php');
require_once('class-nsplugin-gallery.php');

// Home DB types
define('HOME_TYPE_CATEGORY',		0);
define('HOME_TYPE_FOLLOWME',		1);
define('HOME_TYPE_PUBLICATIONS',	2);
define('HOME_TYPE_PROJECTS',		3);
define('HOME_TYPE_POST_ID',			4);
define('HOME_TYPE_ABOUT',			5);
define('HOME_TYPE_SQUARE',			6);

// Color types
define('HOME_COLOR_WHITE',			0);
define('HOME_COLOR_LIGHTGREY',		1);
define('HOME_COLOR_DARKGREY',		2);

/**
 * @class	Nsplugin_Home
 * @brief	This class is an interface with hobby DB data.
 */
class Nsplugin_Home extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_home";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "home_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "home_id",			"type" => DB_TYPE_NUM),
											array("name" => "home_position",	"type" => DB_TYPE_NUM),
											array("name" => "home_type",		"type" => DB_TYPE_SELECT, "options" => array(
												"HOME_TYPE_CATEGORY" =>		HOME_TYPE_CATEGORY,
												"HOME_TYPE_FOLLOWME" =>		HOME_TYPE_FOLLOWME,
												"HOME_TYPE_PUBLICATIONS" =>	HOME_TYPE_PUBLICATIONS,
												"HOME_TYPE_PROJECTS" =>		HOME_TYPE_PROJECTS,
												"HOME_TYPE_POST_ID" =>		HOME_TYPE_POST_ID,
												"HOME_TYPE_ABOUT" =>		HOME_TYPE_ABOUT,
												"HOME_TYPE_SQUARE" =>		HOME_TYPE_SQUARE)),
											array("name" => "home_color",		"type" => DB_TYPE_SELECT, "options" => array(
												"HOME_COLOR_WHITE" =>		HOME_COLOR_WHITE,
												"HOME_COLOR_LIGHTGREY" =>	HOME_COLOR_LIGHTGREY,
												"HOME_COLOR_DARKGREY" =>	HOME_COLOR_DARKGREY)),
											array("name" => "home_term_id",		"type" => DB_TYPE_TERM),
											array("name" => "home_gallery_id",	"type" => DB_TYPE_NUM));
	
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
	 * @brief	Get home section's position.
	 * @return	Home section's position.
	 */
	public function get_position()
	{
		return $this->get_value('home_position');
	}
	
	/**
	 * @func	get_type
	 * @brief	Get home section's type.
	 * @return	Home section's type.
	 */
	public function get_type()
	{
		return $this->get_value('home_type');
	}

	/**
	 * @func	get_color
	 * @brief	Get home section's color.
	 * @return	Home section's color.
	 */
	public function get_color()
	{
		return $this->get_value('home_color');
	}

	/**
	 * @func	get_term
	 * @brief	Get home section's linked category.
	 * @return	Home secion's linked category (WP_Term).
	 */
	public function get_term()
	{
		return $this->get_value('home_term_id');
	}

	/**
	 * @func	get_gallery
	 * @brief	Get home section's linked category.
	 * @return	Home section's linked category.
	 */
	public function get_gallery()
	{
		if(($gallery_id = $this->get_value('home_gallery_id')) != null)
		{
			return Nsplugin_Gallery::get_element_by_id($gallery_id);
		}
	}
	
	/**
	 * @func	get_home
	 * @brief	Get a home section by its ID.
	 * @param	int $id Home section's ID.
	 * @return	A Nsplugin_Home object.
	 */
	static function get_home($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_homes
	 * @brief	Get all home section objects from the DB.
	 * @return	All home section objects from the database.
	 */
	static function get_homes()
	{
		return self::get_records("home_position","asc");
	}
	
}
