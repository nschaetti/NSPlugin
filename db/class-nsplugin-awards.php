<?php

/**
 * Interface for awards database object.
 * 
 * @file class-nsplugin-awards.php
 * @brief Class Nsplugin_Awards is an interface for awards DB object.
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
 * @class	Nsplugin_Awards
 * @brief	This class is an interface with awards DB data.
 */
class Nsplugin_Awards extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_awards";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "award_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "award_id",			"type" => DB_TYPE_NUM),
											array("name" => "award_title",		"type" => DB_TYPE_STRING),
											array("name" => "award_abbr",		"type" => DB_TYPE_STRING),
											array("name" => "award_source",		"type" => DB_TYPE_STRING),
											array("name" => "award_sourceurl",	"type" => DB_TYPE_STRING),
											array("name" => "award_date",		"type" => DB_TYPE_DATE),
											array("name" => "award_reason",		"type" => DB_TYPE_STRING),
											array("name" => "award_reasonurl",	"type" => DB_TYPE_STRING),
											array("name" => "award_post_id",	"type" => DB_TYPE_PAGE));
	
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
	 * @func	get_title
	 * @brief	Get award's title.
	 * @return	Award's title.
	 */
	public function get_title()
	{
		return $this->get_value('award_title');
	}
	
	/**
	 * @func	get_abbr
	 * @brief	Get award's abbreviation.
	 * @return	Award's abbreviation.
	 */
	public function get_abbr()
	{
		return $this->get_value('award_abbr');
	}

	/**
	 * @func	get_source
	 * @brief	Get the organistion's name who gave the award.
	 * @return	Organisation's name.
	 */
	public function get_source()
	{
		return $this->get_value('award_source');
	}

	/**
	 * @func	get_sourceURL
	 * @brief	Get the organistion's URL who gave the award.
	 * @return	Organisation's URL.
	 */
	public function get_sourceURL()
	{
		return $this->get_value('award_sourceURL');
	}

	/**
	 * @func	get_reason
	 * @brief	Gives the reason for the award.
	 * @return	Reason.
	 */
	public function get_reason()
	{
		return $this->get_value('award_reason');
	}

	/**
	 * @func	get_reasonURL
	 * @brief	Get the reason's URL for the award.
	 * @return	Organisation's URL.
	 */
	public function get_reasonURL()
	{
		return $this->get_value('award_reasonURL');
	}

	/**
	 * @func	get_date
	 * @brief	Get award's attributation date.
	 * @return	Attributation date.
	 */
	public function get_date()
	{
		return $this->get_value('award_date');
	}

	/**
	 * @func	get_image
	 * @brief	Get award's corresponding image.
	 * @return	Award's corresponding image.
	 */
	public function get_image()
	{
		return $this->get_value('award_post_id');
	}
	
	/**
	 * @func	get_award
	 * @brief	Get an award object by its ID.
	 * @param	int $id Award's ID.
	 * @return	An award object.
	 */
	static function get_award($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_awards
	 * @brief	Get all award objects in the database.
	 * @return	An array of award objects.
	 */
	static function get_awards()
	{
		return self::get_records("award_id","asc");
	}
	
}
