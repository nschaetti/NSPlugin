<?php

/**
 * Interface for working experiences object.
 * 
 * @file class-nsplugin-workexp.php
 * @brief Class Nsplugin_Working_Experiences is an interface for working experience DB object.
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
 * @class	Nsplugin_Working_Experiences
 * @brief	Class Nsplugin_Working_Experiences is an interface for working experience objects in the DB.
 */
class Nsplugin_Working_Experiences extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_workexp";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "workexp_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "workexp_id",			"type" => DB_TYPE_NUM),
											array("name" => "workexp_position",		"type" => DB_TYPE_STRING),
											array("name" => "workexp_company",		"type" => DB_TYPE_STRING),
											array("name" => "workexp_address",		"type" => DB_TYPE_STRING),
											array("name" => "workexp_country",		"type" => DB_TYPE_STRING),
											array("name" => "workexp_url",			"type" => DB_TYPE_STRING),
											array("name" => "workexp_post_id",		"type" => DB_TYPE_PAGE),
											array("name" => "workexp_honors",		"type" => DB_TYPE_STRING),
											array("name" => "workexp_desc",			"type" => DB_TYPE_STRING),
											array("name" => "workexp_begin",		"type" => DB_TYPE_DATE),
											array("name" => "workexp_end",			"type" => DB_TYPE_DATE),
											array("name" => "workexp_duration",		"type" => DB_TYPE_NUM));
	
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
	 * @brief	Get working experience's position (job position).
	 * @return 	Working experience's position as a string.
	 */
	public function get_position()
	{
		return $this->get_value('workexp_position');
	}
	
	/**
	 * @func	get_company
	 * @brief	Get working experience company.
	 * @return 	Working experience's company as a string.
	 */
	public function get_company()
	{
		return $this->get_value('workexp_company');
	}

	/**
	 * @func	get_address
	 * @brief	Get working experience's address.
	 * @return 	Working experience's address as a string.
	 */
	public function get_address()
	{
		return $this->get_desc('workexp_address');
	}

	/**
	 * @func	get_country
	 * @brief	Get working experiene's country.
	 * @return 	Working experience's country as a string.
	 */
	public function get_country()
	{
		return $this->get_value('workexp_country');
	}
	
	/**
	 * @func	get_url
	 * @brief	Get working experience company's URL.
	 * @return 	Working experience company's URL as a string.
	 */
	public function get_url()
	{
		return $this->get_value('workexp_url');
	}
	
	/**
	 * @func	get_image
	 * @brief	Get working experience's image.
	 * @return 	Working experience's image as a WP_Post.
	 */
	public function get_image()
	{
		return $this->get_value('workexp_post_id');
	}
	
	/**
	 * @func	get_honors
	 * @brief	Get working experience's honors.
	 * @return 	Working experience's honors as a string.
	 */
	public function get_honors()
	{
		return $this->get_value('workexp_honors');
	}
	
	/**
	 * @func	get_desc
	 * @brief	Get working experience's description.
	 * @return 	Working experience's description as a string.
	 */
	public function get_desc()
	{
		return $this->get_value('workexp_desc');
	}
	
	/**
	 * @func	get_begin_date
	 * @brief	Get working experience's begin date.
	 * @return 	Working experience's begin date as a date object.
	 */
	public function get_begin_date()
	{
		return $this->get_value('workexp_begin');
	}
	
	/**
	 * @func	get_end_date
	 * @brief	Get working experience's end date.
	 * @return 	Working experience's end date as a date object.
	 */
	public function get_end_date()
	{
		return $this->get_value('workexp_end');
	}
	
	/**
	 * @func	get_duration
	 * @brief	Get working experience's duration.
	 * @return 	Working experience's duration as a float.
	 */
	public function get_duration()
	{
		return $this->get_value('workexp_duration');
	}
	
	/**
	 * @func	get_working_experience
	 * @brief 	Get a working experience object Nsplugin_Working_Experiences from its ID.
	 * @param 	int $id Working experience's ID in the DB.
	 * @return 	A Nsplugin_Working_Experiences object.
	 */
	static function get_working_experience($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_working_experiences
	 * @brief 	Get all working experience object from the database.
	 * @return 	An array of working experience object.
	 */
	static function get_working_experiences()
	{
		return self::get_records("workexp_end","desc");
	}
	
}
