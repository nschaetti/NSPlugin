<?php

/**
 * Interface for projects object.
 * 
 * @file class-nsplugin-projects.php
 * @brief Class Nsplugin_Projects is an interface for project DB object.
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
define('PROJECT_LINE_LIGHT',			0);
define('PROJECT_LINE_DARK',				1);

/**
 * @class	Nsplugin_Projects
 * @brief	This class is an interface with projects DB data.
 */
class Nsplugin_Projects extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_projects";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "project_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "project_id",						"type" => DB_TYPE_NUM),
											array("name" => "project_name",						"type" => DB_TYPE_STRING),
											array("name" => "project_desc",						"type" => DB_TYPE_STRING),
											array("name" => "project_shortdesc",				"type" => DB_TYPE_STRING),
											array("name" => "project_post_id",					"type" => DB_TYPE_PAGE),
											array("name" => "project_page_post_id",				"type" => DB_TYPE_PAGE),
											array("name" => "project_background_post_id",		"type" => DB_TYPE_PAGE),
											array("name" => "project_foreground_post_id",		"type" => DB_TYPE_PAGE),
											array("name" => "project_gallery_id",				"type" => DB_TYPE_NUM),
											array("name" => "project_bmin",						"type" => DB_TYPE_NUM),
											array("name" => "project_bmax",						"type" => DB_TYPE_NUM),
											array("name" => "project_fmin",						"type" => DB_TYPE_NUM),
											array("name" => "project_fmax",						"type" => DB_TYPE_NUM),
											array("name" => "project_textcolor",				"type" => DB_TYPE_STRING),
											array("name" => "project_buttontextcolor",			"type" => DB_TYPE_STRING),
											array("name" => "project_line",						"type" => DB_TYPE_SELECT, "options" => array(
												"PROJECT_LINE_LIGHT" =>							PROJECT_LINE_LIGHT,
												"PROJECT_LINE_DARK" =>							PROJECT_LINE_DARK)),
											array("name" => "project_startdate",				"type" => DB_TYPE_DATE),
											array("name" => "project_enddate",					"type" => DB_TYPE_DATE),
											array("name" => "project_active",					"type" => DB_TYPE_BOOLEAN),
											array("name" => "project_todisplay",				"type" => DB_TYPE_BOOLEAN),
											array("name" => "project_externalurl",				"type" => DB_TYPE_STRING),
											array("name" => "project_keywords",					"type" => DB_TYPE_STRING),
											array("name" => "project_morecolor",				"type" => DB_TYPE_STRING));
	
	/**
	 * @var 	$m_aTerms
	 * @brief 	Array of all linked terms.
	 */
	private $m_aTerms;
	
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
	 * @brief	Get project's name
	 * @return	Project's name
	 */
	public function get_name()
	{
		return $this->get_value('project_name');
	}
	
	/**
	 * @func	get_desc
	 * @brief	Get project's description.
	 * @return	Project's description.
	 */
	public function get_desc()
	{
		return $this->get_value('project_desc');
	}

	/**
	 * @func	get_shortdesc
	 * @brief	Get project's short description.
	 * @return	Project's short description.
	 */
	public function get_shortdesc()
	{
		return $this->get_desc('project_shortdesc');
	}

	/**
	 * @func	get_image
	 * @brief	Get project's image.
	 * @return	Project's image.
	 */
	public function get_image()
	{
		return $this->get_value('project_post_id');
	}
	
	/**
	 * @func	get_page
	 * @brief	Get project's page.
	 * @return	Project's page (WP_Post).
	 */
	public function get_page()
	{
		return $this->get_value('project_page_post_id');
	}
	
	/**
	 * @func	get_background_image
	 * @brief	Get project's background image.
	 * @return	Project's background image.
	 */
	public function get_background_image()
	{
		return $this->get_value('project_background_post_id');
	}
	
	/**
	 * @func	get_foreground_image
	 * @brief	Get project's foreground image.
	 * @return	Project's foreground image.
	 */
	public function get_foreground_image()
	{
		return $this->get_value('project_foreground_post_id');
	}
	
	/**
	 * @func	get_gallery
	 * @brief	Get project's linked gallery.
	 * @return	Project's linked gallery.
	 */
	public function get_gallery()
	{
		if(($gallery_id = $this->get_value('project_gallery_id')) != null)
		{
			return Nsplugin_Gallery::get_element_by_id($gallery_id);
		}
	}
	
	/**
	 * @func	get_bmin
	 * @brief	Get project's background minimum position.
	 * @return	Project's background minimum position.
	 */
	public function get_bmin()
	{
		return $this->get_value('project_bmin');
	}
	
	/**
	 * @func	get_bmax
	 * @brief	Get project's background maximum position.
	 * @return	Project's background maximum position.
	 */
	public function get_bmax()
	{
		return $this->get_value('project_bmax');
	}
	
	/**
	 * @func	get_fmin
	 * @brief	Get project's foreground minimum position.
	 * @return	Project's foreground minimum position.
	 */
	public function get_fmin()
	{
		return $this->get_value('project_fmin');
	}
	
	/**
	 * @func	get_fmax
	 * @brief	Get project's foreground maximum position.
	 * @return	Foreground maximum position.
	 */
	public function get_fmax()
	{
		return $this->get_value('project_fmax');
	}
	
	/**
	 * @func	get_text_color
	 * @brief	Get project's text color.
	 * @return	Project's text color.
	 */
	public function get_text_color()
	{
		return $this->get_value('project_textcolor');
	}
	
	/**
	 * @func	get_button_text_color
	 * @brief	Get project's button text color.
	 * @return	Project's button text color.
	 */
	public function get_button_text_color()
	{
		return $this->get_value('project_buttontextcolor');
	}
	
	/**
	 * @func	get_line_type
	 * @brief	Get project's line type.
	 * @return	Project's line type (PROJECT_LINE_LIGHT, PROJECT_LINE_DARK)
	 */
	public function get_line_type()
	{
		return $this->get_value('project_line');
	}
	
	/**
	 * @func	get_start_date
	 * @brief	Get project's start date
	 * @return 	Project's start date (date object).
	 */
	public function get_start_date()
	{
		return $this->get_value('project_startdate');
	}
	
	/**
	 * @func	get_end_date
	 * @brief	Get project's end date.
	 * @return 	Project's end date (date object).
	 */
	public function get_end_date()
	{
		return $this->get_value('project_enddate');
	}
	
	/**
	 * @func	is_action
	 * @brief	Is the project currently active.
	 * @return 	True of false if the project is currently active.
	 */
	public function is_active()
	{
		return $this->get_value('project_active');
	}
	
	/**
	 * @func	is_to_display
	 * @brief	Should the project be displayed.
	 * @return 	True of false if the project should be displayed.
	 */
	public function is_to_display()
	{
		return $this->get_value('project_todisplay');
	}
	
	/**
	 * @func	get_externalURL
	 * @brief	Get project's external URL.
	 * @return  Project's external URL as a string.
	 */
	public function get_externalURL()
	{
		return $this->get_value('project_externalurl');
	}
	
	/**
	 * @func	get_keywords
	 * @brief	Get project's keywords
	 * @return  Project's keywords as a string.
	 */
	public function get_keywords()
	{
		return $this->get_value('project_keywords');
	}
	
	/**
	 * @func	get_more_button_color
	 * @brief	Get project more button's color.
	 * @return  Project more button's color.
	 */
	public function get_more_button_color()
	{
		return $this->get_value('project_morecolor');
	}

	/**
	 * @func 	get_terms
	 * @brief 	Get terms linked to the project.
	 * @return 	An array of all terms object (WP_Terms) linked.
	 */
	public function get_terms()
	{
		global $wpdb;

		// Project's ID
		$id = $this->get_value(self::$m_sIDField);

		// Get data
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_projects_terms pt, {$wpdb->prefix}term_taxonomy ta WHERE project_id = $id AND pt.term_id = ta.term_id AND ta.taxonomy LIKE 'category'");

		// Foreach images
		$this->m_aTerms = array();
		foreach($data as $term)
		{
			array_push($this->m_aTerms, get_term($term->term_id));
		}

		return $this->m_aTerms;
	}
    
    /**
	 * @func 	get_tags
	 * @brief 	Get tags linked to the project.
	 * @return 	An array of all terms object (WP_Terms) linked.
	 */
	public function get_tags()
	{
		global $wpdb;

		// Project's ID
		$id = $this->get_value(self::$m_sIDField);

		// Get data
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_projects_terms pt, {$wpdb->prefix}term_taxonomy ta WHERE project_id = $id AND pt.term_id = ta.term_id AND ta.taxonomy LIKE 'post_tag'");

		// Foreach images
		$this->m_aTerms = array();
		foreach($data as $term)
		{
			array_push($this->m_aTerms, get_term($term->term_id));
		}

		return $this->m_aTerms;
	}
	
	/**
	 * @func	get_project
	 * @brief   Get a project object from its ID in the DB.
	 * @param   int $id id
	 * @return  Project object from database.
	 */
	static function get_project($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_projects
	 * @brief   Get all project objects from the database.
	 * @return  An array of project objects.
	 */
	static function get_projects()
	{
		return self::get_records("project_startdate","asc");
	}
	
	/**
	 * @func 	get_projects_by_term
	 * @brief 	Get all projects linked to a category
	 * @param 	integer $term_id Term's ID
	 * @return	Array of Nsplugin_Projects linked to term_id
	 */
	static function get_projects_by_term($term_id)
	{
		global $wpdb;
		$objects = array();
		
		// Class name
		$class_name = get_called_class();
		
		// Get data
		$records = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}projects_terms WHERE term_id = $term_id");
		
		// Foreach record
		foreach($records as $record)
		{
			$object = self::record_to_object($record, $class_name);
			array_push($objects, $object);
		}
		
		return $objects;
	}
	
	/**
	 * @func 	get_projects_by_terms
	 * @brief 	Get all projects linked to a set of categories
	 * @param 	array $terms Array of WP_Term
	 * @return	Array of Nsplugin_Projects linked to term_id
	 */
	static function get_projects_by_terms($terms)
	{
		global $wpdb;
		$objects = array();
		
		// Class name
		$class_name = get_called_class();
		
		// Get IDs
		$ids = array();
		foreach($terms as $term)
		{
			array_push($ids, $term->term_id);
		}
		$in = "(" . join(",",$ids) . ")";
		
		// Get data
		$records = $wpdb->get_results("SELECT DISTINCT project_id FROM {$wpdb->prefix}ns_projects_terms WHERE term_id IN $in");
		
		// Foreach record
		foreach($records as $record)
		{
			$project = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_projects WHERE project_id = {$record->project_id}");
			$object = self::record_to_object($project[0], $class_name);
			array_push($objects, $object);
		}
		
		return $objects;
	}
}
