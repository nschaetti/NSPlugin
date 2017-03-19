<?php

/**
 * Interface for research object.
 * 
 * @file class-nsplugin-researches.php
 * @brief Class Nsplugin_Researches is an interface for research DB object.
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
 * @class	Nsplugin_Researches
 * @brief	Class Nsplugin_Researches is an interface for research objects in the DB.
 */
class Nsplugin_Researches extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_researches";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "research_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "research_id",			"type" => DB_TYPE_NUM),
											array("name" => "research_name",		"type" => DB_TYPE_STRING),
											array("name" => "research_desc",		"type" => DB_TYPE_STRING),
											array("name" => "research_shortdesc",	"type" => DB_TYPE_STRING),
											array("name" => "research_page_post_id","type" => DB_TYPE_PAGE),
											array("name" => "research_gallery_id",	"type" => DB_TYPE_NUM),
											array("name" => "research_keywords",	"type" => DB_TYPE_STRING));
	
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
	 * @brief	Get research field's name.
	 * @return 	Research field's name as a string.
	 */
	public function get_name()
	{
		return $this->get_value('research_name');
	}
	
	/**
	 * @func	get_desc
	 * @brief	Get research field's description.
	 * @return 	Research field's description as a string.
	 */
	public function get_desc()
	{
		return $this->get_value('research_desc');
	}

	/**
	 * @func	get_shortdesc
	 * @brief	Get research field's short description.
	 * @return 	Research field's short description as a string.
	 */
	public function get_shortdesc()
	{
		return $this->get_desc('research_shortdesc');
	}

	/**
	 * @func	get_page
	 * @brief	Get research field's internal page.
	 * @return 	Research field's internal page as WP_Post.
	 */
	public function get_page()
	{
		return $this->get_value('research_page_post_id');
	}
	
	/**
	 * @func	get_gallery
	 * @brief	Get research field's gallery.
	 * @return 	Research field's gallery as a Nsplugin_Gallery object.
	 */
	public function get_gallery()
	{
		if(($gallery_id = $this->get_value('research_gallery_id')) != null)
		{
			return Nsplugin_Gallery::get_element_by_id($gallery_id);
		}
	}
	
	/**
	 * @func	get_keywords.
	 * @brief	Get research field's keywords.
	 * @return 	Research field's keywords as a string.
	 */
	public function get_keywords()
	{
		return $this->get_value('research_keywords');
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
		//echo "SELECT * FROM {$wpdb->prefix}ns_researches_terms WHERE research_id = $id";
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_researches_terms pt, {$wpdb->prefix}term_taxonomy ta WHERE research_id = $id AND pt.term_id = ta.term_id AND ta.taxonomy LIKE 'category'");
		
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
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_researches_terms pt, {$wpdb->prefix}term_taxonomy ta WHERE research_id = $id AND pt.term_id = ta.term_id AND ta.taxonomy LIKE 'post_tag'");
		
		// Foreach images
		$this->m_aTerms = array();
		foreach($data as $term)
		{
			array_push($this->m_aTerms, get_term($term->term_id));
		}

		return $this->m_aTerms;
	}
	
	/**
	 * @func	get_research
	 * @brief 	Get a research object from the DB by its ID.
	 * @param 	int $id Research field's ID in the DB.
	 * @return 	A research field's object Nsplugin_Researches.
	 */
	static function get_research($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_researches
	 * @brief 	Get all research field object stored in the DB.
	 * @return 	An array of Nsplugin_Researches object.
	 */
	static function get_researches()
	{
		return self::get_records("research_name","asc");
	}
	
	/**
	 * @func 	get_researches_by_terms
	 * @brief 	Get all researches linked to a set of categories
	 * @param 	array $terms Array of WP_Term
	 * @return	Array of Nsplugin_Researches linked to term_id
	 */
	static function get_researches_by_terms($terms)
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
		$records = $wpdb->get_results("SELECT DISTINCT research_id FROM {$wpdb->prefix}ns_researches_terms WHERE term_id IN $in");
		
		// Foreach record
		foreach($records as $record)
		{
			$research = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_researches WHERE research_id = {$record->research_id}");
			$object = self::record_to_object($research[0], $class_name);
			array_push($objects, $object);
		}
		
		return $objects;
	}
	
}
