<?php

/**
 * Interface for header object.
 * 
 * @file class-nsplugin-headers.php
 * @brief Class Nsplugin_Headers is an interface for header DB objects.
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
 * @class	Nsplugin_Headers
 * @brief	This class is an interface with header DB data.
 */
class Nsplugin_Headers extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_headers";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "header_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "header_id",				"type" => DB_TYPE_NUM),
											array("name" => "header_position",			"type" => DB_TYPE_NUM),
											array("name" => "header_post_id",			"type" => DB_TYPE_PAGE),
											array("name" => "header_subtitle",			"type" => DB_TYPE_STRING),
											array("name" => "header_desc",				"type" => DB_TYPE_STRING),
											array("name" => "header_page_post_id",		"type" => DB_TYPE_PAGE),
											array("name" => "header_subtitlesize",		"type" => DB_TYPE_NUM),
											array("name" => "header_h1color",			"type" => DB_TYPE_STRING),
											array("name" => "header_h1shadow",			"type" => DB_TYPE_STRING),
											array("name" => "header_h2color",			"type" => DB_TYPE_STRING),
											array("name" => "header_h2shadow",			"type" => DB_TYPE_STRING),
											array("name" => "header_abstractcolor",		"type" => DB_TYPE_STRING),
											array("name" => "header_abstractshadow",	"type" => DB_TYPE_STRING),
											array("name" => "header_menucolor",			"type" => DB_TYPE_STRING),
											array("name" => "header_menushadow",		"type" => DB_TYPE_STRING),
											array("name" => "header_menubordercolor",	"type" => DB_TYPE_STRING),
											array("name" => "header_buttoncolor",		"type" => DB_TYPE_STRING),
											array("name" => "header_buttontextcolor",	"type" => DB_TYPE_STRING),
											array("name" => "header_imagesprefix",		"type" => DB_TYPE_STRING));
	
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
	 * @brief	Get header position.
	 * @return	Header's position.
	 */
	public function get_position()
	{
		return $this->get_value('header_position');
	}
	
	/**
	 * @func	get_image
	 * @brief	Get header's image.
	 * @return	Header's image.
	 */
	public function get_image()
	{
		return $this->get_value('header_post_id');
	}

	/**
	 * @func	get_subtitle
	 * @brief	Get header's subtitle.
	 * @return	Header's subtitle.
	 */
	public function get_subtitle()
	{
		return $this->get_value('header_subtitle');
	}
	
	/**
	 * @func	get_desc
	 * @brief	Get header's description.
	 * @return	Header's description.
	 */
	public function get_desc()
	{
		return $this->get_value('header_desc');
	}
	
	/**
	 * @func	get_post
	 * @brief	Get header post.
	 * @return	Header's post as a WP_Post object.
	 */
	public function get_page()
	{
		return $this->get_value('header_page_post_id');
	}
	
	/**
	 * @func	get_h1_color
	 * @brief	Get header main title color.
	 * @return	Header main title's  color.
	 */
	public function get_h1_color()
	{
		return $this->get_value('header_h1color');
	}

	/**
	 * @func	get_h1_shadow
	 * @brief	Get header main title shadow.
	 * @return	Header main title's shadow.
	 */
	public function get_h1_shadow()
	{
		return $this->get_value('header_h1shadow');
	}
	
	/**
	 * @func	get_h2_color
	 * @brief	Get header subtitle color.
	 * @return	Header subtitle color.
	 */
	public function get_h2_color()
	{
		return $this->get_value('header_h2color');
	}

	/**
	 * @func	get_h2_shadow
	 * @brief	Get header subtitle shadow.
	 * @return	Header menu subtitle shadow.
	 */
	public function get_h2_shadow()
	{
		return $this->get_value('header_h2shadow');
	}
	
	/**
	 * @func	get_abstract_color
	 * @brief	Get header abstract color.
	 * @return	Header menu abstract color.
	 */
	public function get_abstract_color()
	{
		return $this->get_value('header_abstractcolor');
	}

	/**
	 * @func	get_abstract_shadow
	 * @brief	Get header abstract's shadow.
	 * @return	Header abstract's shadow.
	 */
	public function get_abstract_shadow()
	{
		return $this->get_value('header_abstractshadow');
	}
	
	/**
	 * @func	get_menu_color
	 * @brief	Get header menu's color.
	 * @return	Header menu's color.
	 */
	public function get_menu_color()
	{
		return $this->get_value('header_menucolor');
	}

	/**
	 * @func	get_menu_shadow
	 * @brief	Get header menu's shadow.
	 * @return	Header menu's shadow.
	 */
	public function get_menu_shadow()
	{
		return $this->get_value('header_menushadow');
	}
	
	/**
	 * @func	get_menu_border_color
	 * @brief	Get header menu's border color.
	 * @return	Header menu's border color.
	 */
	public function get_menu_border_color()
	{
		return $this->get_value('header_menubordercolor');
	}

	/**
	 * @func	get_button_color
	 * @brief	Get header button's color.
	 * @return	Header button's color.
	 */
	public function get_button_color()
	{
		return $this->get_value('header_buttoncolor');
	}
	
	/**
	 * @func	get_button_text_color
	 * @brief	Get header button's text color.
	 * @return	Header button's text color.
	 */
	public function get_button_text_color()
	{
		return $this->get_value('header_buttontextcolor');
	}

	/**
	 * @func	get_images_prefix
	 * @brief	Get header's image prefix.
	 * @return	Header's image prefix.
	 */
	public function get_images_prefix()
	{
		return $this->get_value('header_imagesprefix');
	}
	
	/**
	 * @func	get_header
	 * @brief	Get a header object by its ID.
	 * @param	int $id Header's ID to get.
	 * @return	A Nsplugin_Header.
	 */
	static function get_header($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_headers
	 * @brief	Get all header objects from database.
	 * @return	An array with all the header objects from database.
	 */
	static function get_headers()
	{
		return self::get_records("header_position","asc");
	}
	
}
