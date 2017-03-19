<?php

/**
 * Interface for gallery object.
 * 
 * @file class-nsplugin-gallery.php
 * @brief Class Nsplugin_Gallery is an interface for gallery DB object.
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
 * @class	Nsplugin_Gallery
 * @brief	This class is an interface with gallery DB data.
 */
class Nsplugin_Gallery extends Nsplugin_Db_Object
{
	
	/************************************************
	 **************** Variables *********************
	 ************************************************/
	 
	/**
	 * @var		$m_sTable
	 * @brief	Corresponding table
	 */
	static public $m_sTable = "wp_ns_gallery";
	
	/**
	 * @var		$m_sIDField;
	 * @brief	The field with primary key
	 */
	static public $m_sIDField = "gallery_id";
	
	/**
	 * @var		$m_aTableDesc
	 * @brief	This array describes the table's fields.
	 */
	static public $m_aTableDesc = array(	array("name" => "gallery_id",		"type" => DB_TYPE_NUM),
											array("name" => "gallery_name",		"type" => DB_TYPE_STRING),
											array("name" => "gallery_desc",		"type" => DB_TYPE_STRING),
											array("name" => "gallery_post_id",	"type" => DB_TYPE_PAGE),
											array("name" => "gallery_displayed","type" => DB_TYPE_BOOLEAN));

	/**
	 * @var 	$m_aImages
	 * @brief 	Linked images
	 */
	private $m_aImages;
	
	/************************************************
	 ***************** Functions ********************
	 ************************************************/
	
	/**
	 * @func	__construct
	 * @brief	Constructor
	 */
	function __construct($fields_value)
	{
		// Field's values
		$this->m_aFieldsValue = $fields_value;

		// Load images
		$this->load_images();
	}

	/**
	 * @func	load_images
	 * @brief	Load gallery's images
	 */
	private function load_images()
	{
		global $wpdb;

		// Gallery's ID
		$id = $this->get_value(self::$m_sIDField);

		// Get data
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_gallery_posts WHERE gallery_id = $id");

		// Foreach images
		$this->m_aImages = array();
		foreach($data as $image)
		{
			array_push($this->m_aImages, get_post($image->post_id));
		}
	}

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
	 * @brief	Get gallery's name
	 * @return	Gallery's name
	 */
	public function get_name()
	{
		return $this->get_value('gallery_name');
	}
	
	/**
	 * @func	get_abbr
	 * @brief	Get gallery's description.
	 * @return	Gallery's description.
	 */
	public function get_desc()
	{
		return $this->get_value('gallery_desc');
	}

	/**
	 * @func	get_image
	 * @brief	Get gallery's main image.
	 * @return	Gallery's main image.
	 */
	public function get_image()
	{
		return $this->get_value('gallery_post_id');
	}

	/**
	 * @func 	get_images
	 * @brief	Get gallery's images
	 * @return	An array of WP_Post.
	 */
	public function get_images()
	{
		$this->load_images();
		return $this->m_aImages;
	}

	public function get_displayed()
	{
		return $this->get_value('gallery_displayed');
	}
	
	/**
	 * @func	get_gallery
	 * @brief	Get a gallery object by ID.
	 * @param	int $id Galler'y ID.
	 * @return	The corresponding gallery object.
	 */
	static function get_gallery($id)
	{
		return self::get_element_by_id($id);
	}
	
	/**
	 * @func	get_galleries
	 * @brief	Get all gallery objects.
	 * @return	An array containing all gallery objects from DB.
	 */
	static function get_galleries()
	{
		return self::get_records("gallery_id","asc");
	}
	
}
