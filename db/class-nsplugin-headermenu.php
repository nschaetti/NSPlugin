<?php

/**
 * Interface for all header menu objects.
 * 
 * @file class-nsplugin-headermenu.php
 * @brief Class Nsplugin_HeaderMenu is an interface for header menu DB objects
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
 * @class	Nsplugin_HeaderMenu
 * @brief	This class is an interface with header DB data.
 */
class Nsplugin_HeaderMenu extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_headermenu";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "headermenu_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "headermenu_id",		"type" => DB_TYPE_NUM),
											array("name" => "headermenu_position",	"type" => DB_TYPE_NUM),
											array("name" => "headermenu_title",		"type" => DB_TYPE_STRING),
											array("name" => "headermenu_post_id",	"type" => DB_TYPE_PAGE),
											array("name" => "headermenu_url",		"type" => DB_TYPE_STRING));
	
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
	 * @brief	Get header menu's position.
	 * @return	Header menu's position.
	 */
	public function get_position()
	{
		return $this->get_value('headermenu_position');
	}
	
	/**
	 * @func	get_title
	 * @brief	Get header menu's title.
	 * @return	Header menu's title.
	 */
	public function get_title()
	{
		return $this->get_value('headermenu_title');
	}
	
	/**
	 * @func	get_page
	 * @brief	Get header menu's page.
	 * @return	Header menu's page.
	 */
	public function get_page()
	{
		return $this->get_value('headermenu_post_id');
	}
	
	/**
	 * @func	get_url
	 * @brief	Get header menu's url.
	 * @return	Header menu's url.
	 */
	public function get_url()
	{
		return $this->get_value('headermenu_url');
	}
	
	/**
	 * @func	get_headermenu
	 * @brief	Get a header menu object by its ID.
	 * @param	int $id Header menu's ID.
	 * @return	A Nsplugin_Header_Menu object.
	 */
	static function get_headermenu($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_headermenus
	 * @brief	Get all header menu objects from the DB.
	 * @return	An array of all header menu objects from the DB.
	 */
	static function get_headermenus()
	{
		return self::get_records("headermenu_position","asc");
	}
	
}
