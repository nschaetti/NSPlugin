<?php

/**
 * Interface for education object.
 * 
 * @file class-nsplugin-education.php
 * @brief Class Nsplugin_Education is an interface for education DB objects.
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
 * @class	Nsplugin_Education
 * @brief	This class is an interface with education DB data.
 */
class Nsplugin_Education extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_education";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "edu_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "edu_id",			"type" => DB_TYPE_NUM),
											array("name" => "edu_degree",		"type" => DB_TYPE_STRING),
											array("name" => "edu_college",		"type" => DB_TYPE_STRING),
											array("name" => "edu_country",		"type" => DB_TYPE_STRING),
											array("name" => "edu_url",			"type" => DB_TYPE_STRING),
											array("name" => "edu_post_id",		"type" => DB_TYPE_PAGE),
											array("name" => "edu_major",		"type" => DB_TYPE_STRING),
											array("name" => "edu_minor",		"type" => DB_TYPE_STRING),
											array("name" => "edu_begin",		"type" => DB_TYPE_DATE),
											array("name" => "edu_end",			"type" => DB_TYPE_DATE),
											array("name" => "edu_honors",		"type" => DB_TYPE_STRING),
											array("name" => "edu_desc",			"type" => DB_TYPE_STRING));
	
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
	 * @func	get_degree
	 * @brief	Get education's degree.
	 * @return	Education's degree.
	 */
	public function get_degree()
	{
		return $this->get_value('edu_degree');
	}
	
	/**
	 * @func	get_college
	 * @brief	Get education entry's college.
	 * @return	Education entry's college.
	 */
	public function get_college()
	{
		return $this->get_value('edu_college');
	}

	/**
	 * @func	get_country
	 * @brief	Get education entry's country.
	 * @return	Education entry's country.
	 */
	public function get_country()
	{
		return $this->get_value('edu_country');
	}

	/**
	 * @func	get_url
	 * @brief	Get education entry's link.
	 * @return	Education entry's link.
	 */
	public function get_url()
	{
		return $this->get_value('edu_url');
	}

	/**
	 * @func	get_image
	 * @brief	Get education entry's image.
	 * @return	Education entry's image.
	 */
	public function get_image()
	{
		return $this->get_value('edu_post_id');
	}

	/**
	 * @func	get_major
	 * @brief	Get degree's major subject.
	 * @return	Degree's major subject.
	 */
	public function get_major()
	{
		return $this->get_value('edu_major');
	}

	/**
	 * @func	get_minor
	 * @brief	Get degree's minor subject.
	 * @return	Degree's minor subject.
	 */
	public function get_minor()
	{
		return $this->get_value('edu_minor');
	}

	/**
	 * @func	get_begin_date
	 * @brief	Get education's begin date.
	 * @return	Education's begin date.
	 */
	public function get_begin_date()
	{
		return $this->get_value('edu_begin');
	}

	/**
	 * @func	get_end_date
	 * @brief	Get education's end date.
	 * @return	Education's end date.
	 */
	public function get_end_date()
	{
		return $this->get_value('edu_end');
	}

	/**
	 * @func	get_honors
	 * @brief	Get degree's honors.
	 * @return	Degree's honors.
	 */
	public function get_honors()
	{
		return $this->get_value('edu_honors');
	}

	/**
	 * @func	get_desc
	 * @brief	Get degree's description.
	 * @return	Degree's description.
	 */
	public function get_desc()
	{
		return $this->get_value('edu_desc');
	}
	
	/**
	 * @func	get_education
	 * @brief	Get an education's entry by ID.
	 * @param	int $id Education entry's ID to load.
	 * @return	An education object.
	 */
	static function get_education($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_education_records
	 * @brief	Get all education objects from the database.
	 * @return	An array of education objects.
	 */
	static function get_education_records()
	{
		return self::get_records("edu_end","desc");
	}
	
}
