<?php

/**
 * Interface for publication object.
 * 
 * @file class-nsplugin-publications.php
 * @brief Class Nsplugin_Publications is an interface for publication objects in the DB.
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Load abstract class
require_once('class-nsplugin-db-object.php');

// Publication type
define('PUB_TYPE_CONFERENCE_PAPER',		0);
define('PUB_TYPE_JOURNAL_PAPER',		1);
define('PUB_TYPE_BOOK',					2);
define('PUB_TYPE_MASTER_THESIS',		3);
define('PUB_TYPE_PHD_THESIS',			4);
define('PUB_TYPE_POSTER',				5);

// Publication file types
define('PUB_FILETYPE_PDF',				0);
define('PUB_FILETYPE_HTML',				1);

/**
 * @class	Nsplugin_Publications
 * @brief	This class is an interface with publication DB data.
 */
class Nsplugin_Publications extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_publications";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "pub_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "pub_id",			"type" => DB_TYPE_NUM),
											array("name" => "pub_title",		"type" => DB_TYPE_STRING),
											array("name" => "pub_authors",		"type" => DB_TYPE_STRING),
											array("name" => "pub_abstract",		"type" => DB_TYPE_STRING),
											array("name" => "pub_date",			"type" => DB_TYPE_DATE),
											array("name" => "pub_url",			"type" => DB_TYPE_STRING),
											array("name" => "pub_post_id",		"type" => DB_TYPE_PAGE),
											array("name" => "pub_keywords",		"type" => DB_TYPE_STRING),
											array("name" => "pub_type",			"type" => DB_TYPE_SELECT, "options" => array(
												"PUB_TYPE_CONFERENCE_PAPER" =>	PUB_TYPE_CONFERENCE_PAPER,
												"PUB_TYPE_JOURNAL_PAPER" =>		PUB_TYPE_JOURNAL_PAPER,
												"PUB_TYPE_BOOK" =>				PUB_TYPE_BOOK,
												"PUB_TYPE_MASTER_THESIS" =>		PUB_TYPE_MASTER_THESIS,
												"PUB_TYPE_PHD_THESIS" =>		PUB_TYPE_PHD_THESIS,
												"PUB_TYPE_POSTER" =>			PUB_TYPE_POSTER)),
											array("name" => "pub_publisher",	"type" => DB_TYPE_STRING),
											array("name" => "pub_edition",		"type" => DB_TYPE_STRING),
											array("name" => "pub_publisherlink","type" => DB_TYPE_STRING),
											array("name" => "pub_publishercomp","type" => DB_TYPE_STRING),
											array("name" => "pub_filetype",		"type" => DB_TYPE_SELECT, "options" => array(
												"PUB_FILETYPE_PDF" =>			PUB_FILETYPE_PDF,
												"PUB_FILETYPE_HTML" =>			PUB_FILETYPE_HTML)));
	
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
	 * @func	get_title
	 * @brief	Get publication's title.
	 * @return	Publication's title as a string.
	 */
	public function get_title()
	{
		return $this->get_value('pub_title');
	}
	
	/**
	 * @func	get_authors
	 * @brief	Get publication's authors.
	 * @return 	Publication's authors as a string.
	 */
	public function get_authors()
	{
		return $this->get_value('pub_authors');
	}

	/**
	 * @func	get_abstract
	 * @brief	Get publication's abstract.
	 * @return 	Publication's abstract as a string.
	 */
	public function get_abstract()
	{
		return $this->get_desc('pub_abstract');
	}

	/**
	 * @func	get_date
	 * @brief	Get publication's date.
	 * @return 	Publication's date as a date object.
	 */
	public function get_date()
	{
		return $this->get_value('pub_date');
	}
	
	/**
	 * @func	get_url
	 * @brief	Get publication's URL.
	 * @return 	Publication's URL as a string.
	 */
	public function get_url()
	{
		return $this->get_value('pub_url');
	}
	
	/**
	 * @func	get_imag
	 * @brief	Get publication's image.
	 * @return 	Publication's image as a WP_Post object.
	 */
	public function get_image()
	{
		return $this->get_value('pub_post_id');
	}
	
	/**
	 * @func	get_keywords
	 * @brief	Get publication's keywords.
	 * @return 	Publication's keywords as a string.
	 */
	public function get_keywords()
	{
		return $this->get_value('pub_keywords');
	}
	
	/**
	 * @func	get_type
	 * @brief	Get publication's type.
	 * @return  Publication's type as (PUB_TYPE_CONFERENCE_PAPER, PUB_TYPE_JOURNAL_PAPER, PUB_TYPE_BOOK, PUB_TYPE_MASTER_THESIS, PUB_TYPE_PHD_THESIS, PUB_TYPE_POSTER)
	 */
	public function get_type()
	{
		return $this->get_value('pub_type');
	}
	
	/**
	 * @func	get_publisher
	 * @brief	Get publication's publisher.
	 * @return 	Publication's publisher as a string.
	 */
	public function get_publisher()
	{
		return $this->get_value('pub_publisher');
	}
	
	/**
	 * @func	get_edition
	 * @brief	Get publication's edition.
	 * @return 	Publication's edition as a string.
	 */
	public function get_edition()
	{
		return $this->get_value('pub_edition');
	}
	
	/**
	 * @func	get_publisher_link
	 * @brief	Get publiation publisher's link.
	 * @return 	Publication publisher's link as a string.
	 */
	public function get_publisher_link()
	{
		return $this->get_value('pub_publisherlink');
	}
	
	/**
	 * @func	get_publishercomp
	 * @brief	Get publication publisher's complemental informations.
	 * @return 	Publication publisher's complemental informations as a string.
	 */
	public function get_publishercomp()
	{
		return $this->get_value('pub_publishercomp');
	}
	
	/**
	 * @func	get_file_type
	 * @brief	Get publication's file type.
	 * @return 	Publication's file type as (PUB_FILETYPE_PDF,PUB_FILETYPE_HTML)
	 */
	public function get_file_type()
	{
		return $this->get_value('pub_filetype');
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
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_publications_terms pt, {$wpdb->prefix}term_taxonomy ta WHERE pub_id = $id AND pt.term_id = ta.term_id AND ta.taxonomy LIKE 'category'");

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
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_publications_terms pt, {$wpdb->prefix}term_taxonomy ta WHERE pub_id = $id AND pt.term_id = ta.term_id AND ta.taxonomy LIKE 'post_tag'");

		// Foreach images
		$this->m_aTerms = array();
		foreach($data as $term)
		{
			array_push($this->m_aTerms, get_term($term->term_id));
		}

		return $this->m_aTerms;
	}
	
	/**
	 * @func	get_publication
	 * @brief 	Get publication from DB by its ID.
	 * @param 	int $id Publication's ID in the DB.
	 * @return 	A publication object (Nsplugin_Publications)
	 */
	static function get_publication($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_publications
	 * @brief 	Get all publication stored in the DB.
	 * @return 	Array of Nsplugin_Publications object.
	 */
	static function get_publications($limit = -1)
	{
		return self::get_records("pub_date","desc", $limit);
	}
	
	/**
	 * @func	Display
	 * @brief	Display the publication
	 */
	public function Display()
	{
		// Pubtex
		$pubtex = "";
		
		// Authors
		$pubtex .= $this->get_authors() .", ";
		
		// Title
		$pubtex .= "<a href=\"{$this->get_url()}\">\"{$this->get_title()}\"</a>, ";
		
		// Publisher
		$pubtex .= "<a href=\"{$this->get_publisher_link()}\"><i>{$this->get_publisher()}</i></a>, ";
		
		// Complement
		if($this->get_publishercomp() != "")
			$pubtex .= $this->get_publishercomp() . ", ";
		
		// Date
		$pubtex .= "({$this->get_date()->format('m/Y')}). ";
		
		// For each category
		foreach($this->get_terms() as $term)
		{
			$pubtex .= "<a href=\"/index.php/{$term->slug}/\">{$term->name}</a> ";
		}
		
		// Type
		$pubtex .= "(" . Nsplugin_Publications::typeToString($this->get_file_type()) . ")";
		
		// Display
		echo $pubtex;
	}
	
	/**
	 * @func	typeToString
	 * @brief	Type of publications
	 */
	public static function typeToString($type)
	{
		switch($type)
		{
			case "PUB_TYPE_CONFERENCE_PAPER":
				return "Conference paper";
				break;
			case "PUB_TYPE_JOURNAL_PAPER":
				return "Journal paper";
				break;
			case "PUB_TYPE_BOOK":
				return "Book";
				break;
			case "PUB_TYPE_MASTER_THESIS":
				return "Masters thesis";
				break;
			case "PUB_TYPE_PHD_THESIS":
				return "PhD thesis";
				break;
			case "PUB_TYPE_POSTER":
				return "Poster";
				break;
		}
	}
	
	/**
	 * @func	fileTypeToString
	 * @brief	Transform database value to string
	 * @return	File type as a string.
	 */
	public static function fileTypeToString($type)
	{
		switch($type)
		{
			case 1:
			case "PUB_FILETYPE_HTML":
				return "HTML";
				break;
			case 2:
			case "PUB_FILETYPE_PDF":
				return "PDF";
				break;
		}
	}
	
	public static function get_by_year($year)
	{
		global $wpdb;
		$objects = array();
		
		// Request
		$records = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}ns_publications` WHERE YEAR(pub_date) = $year;");
		
		// Class name
		$class_name = get_called_class();
		
		// Foreach record
		foreach($records as $record)
		{
			$object = self::record_to_object($record, $class_name);
			array_push($objects, $object);
		}
		
		// Return
		return $objects;
	}
	
	public static function get_by_subject($term_id)
	{
		global $wpdb;
		$objects = array();
		
		// Request
		$records = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_publications pu, {$wpdb->prefix}ns_publications_terms pt, {$wpdb->prefix}term_taxonomy tt WHERE pu.pub_id = pt.pub_id AND pt.term_id = $term_id AND pt.term_id = tt.term_id AND tt.taxonomy LIKE 'category';");
		
		// Class name
		$class_name = get_called_class();
		
		// Foreach record
		foreach($records as $record)
		{
			$object = self::record_to_object($record, $class_name);
			array_push($objects, $object);
		}
		
		// Return
		return $objects;
	}

	public static function get_by_terms($terms)
	{
		global $wpdb;
		$objects = array();
		
		// For each terms
		$ids = array();
		foreach($terms as $term)
			array_push($ids, $term->term_id);
		$in = "(" . join(",",$ids) . ")";

		// Request
		$records = $wpdb->get_results("SELECT DISTINCT pu.* FROM {$wpdb->prefix}ns_publications pu, {$wpdb->prefix}ns_publications_terms pt WHERE pu.pub_id = pt.pub_id AND pt.term_id IN " . $in . " ORDER BY pu.pub_date DESC;");
		
		// Class name
		$class_name = get_called_class();
		
		// Foreach record
		foreach($records as $record)
		{
			$object = self::record_to_object($record, $class_name);
			array_push($objects, $object);
		}
		
		// Return
		return $objects;
	}
	
	public static function get_by_type($type)
	{
		global $wpdb;
		$objects = array();
		
		// Request
		$records = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}ns_publications` WHERE pub_type like '$type';");
		
		// Class name
		$class_name = get_called_class();
		
		// Foreach record
		foreach($records as $record)
		{
			$object = self::record_to_object($record, $class_name);
			array_push($objects, $object);
		}
		
		// Return
		return $objects;
	}
	
	public static function get_year_list()
	{
		global $wpdb;
		
		// Request
		$request = "SELECT YEAR(pub_date) as year FROM `{$wpdb->prefix}ns_publications` GROUP BY YEAR(pub_date)";
		
		// Return
		return($wpdb->get_results($request));
	}
	
	public static function get_type_list()
	{
		global $wpdb;
		
		// Request
		$request = "SELECT DISTINCT pu.pub_type as type FROM {$wpdb->prefix}ns_publications pu GROUP BY pu.pub_type";
		
		// Return
		return($wpdb->get_results($request));
	}
	
	public static function get_subject_list()
	{
		global $wpdb;
		
		// Request
		$request = "SELECT pt.term_id as term_id, te.name as name FROM {$wpdb->prefix}ns_publications pu, {$wpdb->prefix}ns_publications_terms pt, {$wpdb->prefix}terms te, {$wpdb->prefix}term_taxonomy tt WHERE pu.pub_id = pt.pub_id AND pt.term_id = te.term_id AND te.term_id = tt.term_id AND tt.taxonomy LIKE 'category' GROUP BY pt.term_id";
		
		// Return
		return($wpdb->get_results($request));
	}
	
}
