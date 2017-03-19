<?php

/**
 * Interface for languages object.
 * 
 * @file class-nsplugin-languages.php
 * @brief Class Nsplugin_Languages is an interface for language DB object.
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Load abstract class
require_once('class-nsplugin-db-object.php');

// Language levels
define('LANG_LEVEL_NONE',			0);
define('LANG_LEVEL_BEGINNER',		1);
define('LANG_LEVEL_INTERMEDIATE',	2);
define('LANG_LEVEL_ADVANCED',		3);
define('LANG_LEVEL_NATURAL',		4);

/**
 * @class	Nsplugin_Languages
 * @brief	This class is an interface with hobby DB data.
 */
class Nsplugin_Languages extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_languages";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "lang_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "lang_id",			"type" => DB_TYPE_NUM),
											array("name" => "lang_language",	"type" => DB_TYPE_STRING),
											array("name" => "lang_level",		"type" => DB_TYPE_SELECT, "options" => array(
												"LANG_LEVEL_NONE" =>			LANG_LEVEL_NONE,
												"LANG_LEVEL_BEGINNER" =>		LANG_LEVEL_BEGINNER,
												"LANG_LEVEL_INTERMEDIATE" =>	LANG_LEVEL_INTERMEDIATE,
												"LANG_LEVEL_ADVANCED" =>		LANG_LEVEL_ADVANCED,
												"LANG_LEVEL_NATURAL" =>			LANG_LEVEL_NATURAL)),
											array("name" => "lang_desc",		"type" => DB_TYPE_STRING),
											array("name" => "lang_post_id",		"type" => DB_TYPE_PAGE));
	
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
	 * @func	get_language
	 * @brief	Get language's name.
	 * @return	Language's name.
	 */
	public function get_language_name()
	{
		return $this->get_value('lang_language');
	}
	
	/**
	 * @func	get_level
	 * @brief	Get language's level.
	 * @return	Language's level.
	 */
	public function get_level()
	{
		return $this->get_value('lang_level');
	}

	/**
	 * @func	get_desc
	 * @brief	Get language's description.
	 * @return 	Language's description as a string.
	 */
	public function get_desc()
	{
		return $this->get_desc('lang_desc');
	}

	/**
	 * @func	get_image
	 * @brief	Get language's image.
	 * @return 	Language's image as a WP_Post.
	 */
	public function get_image()
	{
		return $this->get_value('lang_post_id');
	}
	
	/**
	 * @func	get_language
	 * @brief 	Get a Nsplugin_Languages from the DB by its ID.
	 * @param 	int $id Language's ID in the DB.
	 * @return 	A Nsplugin_Languages object.
	 */
	static function get_language($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_languages
	 * @brief 	Get all languages from the DB.
	 * @return 	Get all language objects store in the DB.
	 */
	static function get_languages()
	{
		return self::get_records("lang_id","asc");
	}
	
}
