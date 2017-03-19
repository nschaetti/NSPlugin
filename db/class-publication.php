<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/public
 */

// Get database object
global $wpdb ;

define('SELECT_BY_NONE',		0);
define('SELECT_BY_YEAR',		1);
define('SELECT_BY_SUBJECT',		2);
define('SELECT_BY_TYPE',		3);

class Nsplugin_Publication
{
	/********************************************
	 * VARIABLES
	 ********************************************/
	
	public $m_iID;
	
	public $m_sTitle;
	
	public $m_sAuthors;
	
	public $m_sAbstract;
	
	public $m_dPubdate;
	
	public $m_sLink;
	
	public $m_iTermID;
	
	public $m_sCategoryName;
	
	public $m_sCategorySlug;
	
	public $m_iMID;
	
	public $m_sGUID;
	
	public $m_sKeywords;
	
	public $m_iType;
	
	public $m_sPublisher;
	
	public $m_sEdition;
	
	public $m_sPublisherLink;
	
	public $m_sPublisherComplement;
	
	/********************************************
	 * CONSTRUCTOR FUNCTIONS
	 ********************************************/
	
	/**
	 * Constructor
	 */
	function __construct($id, $title, $authors, $abstract, $pubdate, $link, $catid, $categoryname, $categoryslug, $mid, $guid, $keywords, $type, $publisher, $edition, $publisherlink, $publishercomplement)
	{
		$this->m_iID = $id;
		$this->m_sTitle = $title;
		$this->m_sAuthors = $authors;
		$this->m_sAbstract = $abstract;
		$this->m_dPubdate = $pubdate;
		$this->m_sLink = $link;
		$this->m_iTermID = $catid;
		$this->m_sCategoryName = $categoryname;
		$this->m_sCategorySlug = $categoryslug;
		$this->m_iMID = $mid;
		$this->m_sGUID = $guid;
		$this->m_sKeywords = $keywords;
		$this->m_iType = $type;
		$this->m_sPublisher = $publisher;
		$this->m_sEdition = $edition;
		$this->m_sPublisherLink = $publisherlink;
		$this->m_sPublisherComplement = $publishercomplement;
	}
	
	/*******************************************
	 * FUNCTIONS
	 *******************************************/
	 
	/**
	 * Display the publication
	 */
	public function Display()
	{
		// Pubtex
		$pubtex = "";
		
		// Authors
		$pubtex .= $this->m_sAuthors .", ";
		
		// Title
		$pubtex .= "<a href=\"{$this->m_sLink}\">\"{$this->m_sTitle}\"</a>, ";
		
		// Publisher
		$pubtex .= "<a href=\"{$this->m_sPublisherLink}\"><i>{$this->m_sPublisher}</i></a>, ";
		
		// Complement
		if($this->m_sPublisherComplement != "")
			$pubtex .= $this->m_sPublisherComplement . ", ";
		
		// Date
		$pubtex .= "({$this->m_dPubdate->format('m/Y')}). ";
		
		// Category
		$pubtex .= "<a href=\"/index.php/{$this->m_sCategorySlug}/\">{$this->m_sCategoryName}</a> ";
		
		// Type
		$pubtex .= "(" . Nsplugin_Publication::typeToString($this->m_iType) . ")";
		
		// Display
		echo $pubtex;
	}
	
	/*******************************************
	 * STATIC FUNCTIONS
	 *******************************************/
	
	public static function Load($limit = -1, $orderby = "pubdate", $order = "desc", $type = -1, $selectby = SELECT_BY_NONE, $select_value = 0)
	{
		global $wpdb;
		$pub_array = array();
		
		// Filters
		$filters = "";
		if($type != -1)
			$filters .= " type = $type";
		
		// Request
		$request = "";
		if($filters != "")
			$request .= "SELECT * FROM {$wpdb->prefix}nspublications pu, {$wpdb->prefix}posts po, {$wpdb->prefix}terms te WHERE pu.mid = po.ID AND pu.term_id = te.term_id AND " . $filters;
		else
			$request .= "SELECT * FROM {$wpdb->prefix}nspublications pu, {$wpdb->prefix}posts po, {$wpdb->prefix}terms te WHERE pu.mid = po.ID AND pu.term_id = te.term_id ";
		
		// Select by
		if($selectby != SELECT_BY_NONE)
		{
			switch($selectby)
			{
				case SELECT_BY_SUBJECT:
					if(is_array($select_value))
						$request .= " AND pu.term_id IN (" . implode(",",$select_value) . ")";
					else
						$request .= " AND pu.term_id = $select_value";
					break;
				case SELECT_BY_TYPE:
					$request .= " AND pu.type = $select_value";
					break;
				case SELECT_BY_YEAR:
					$request .= " AND YEAR(pu.pubdate) = $select_value";
					break;
			}
		}
		
		// ORDER
		$request .= " ORDER BY $orderby $order";
		
		// Limit
		if($limit != -1)
			$request .= " LIMIT $limit";
		
		// Get all sections
		$request .= ";";
		$publications = $wpdb->get_results($request);
		
		// For each of those
		foreach($publications as $pub)
		{
			array_push($pub_array, new Nsplugin_Publication($pub->id, $pub->title, $pub->authors, $pub->abstract, DateTime::createFromFormat("Y-m-d", $pub->pubdate), $pub->link, $pub->term_id, $pub->name, $pub->slug, $pub->mid, $pub->guid, $pub->keywords, $pub->type, $pub->publisher, $pub->edition, $pub->publisherlink, $pub->publishercomp));
		}
		
		return $pub_array;
	}
	
	public static function getByCategory($term_id, $limit = -1, $orderby = "pubdate", $order = "desc")
	{
		global $wpdb;
		$pub_array = array();
		
		// Request
		$request = "";
		$request .= "SELECT * FROM {$wpdb->prefix}nspublications pu, {$wpdb->prefix}posts po, {$wpdb->prefix}terms te1, {$wpdb->prefix}terms te2 WHERE (pu.term_id = $term_id OR pu.term_id_2 = $term_id) AND pu.mid = po.ID AND pu.term_id = te1.term_id AND pu.term_id_2 = te2.term_id";
		
		// ORDER
		$request .= " ORDER BY $orderby $order";
		
		// Limit
		if($limit != -1)
			$request .= " LIMIT $limit";
		
		// Get all sections
		$request .= ";";
		$publications = $wpdb->get_results($request);
		
		// For each of those
		foreach($publications as $pub)
		{
			array_push($pub_array, new Nsplugin_Publication($pub->id, $pub->title, $pub->authors, $pub->abstract, DateTime::createFromFormat("Y-m-d", $pub->pubdate), $pub->link, $pub->term_id, $pub->name, $pub->slug, $pub->mid, $pub->guid, $pub->keywords, $pub->type, $pub->publisher, $pub->edition, $pub->publisherlink, $pub->publishercomp));
		}
		
		return $pub_array;
	}
	
	public static function getYearList()
	{
		global $wpdb;
		
		// Request
		$request = "SELECT YEAR(pubdate) as year FROM `wp_nspublications` GROUP BY YEAR(pubdate)";
		
		// Return
		return($wpdb->get_results($request));
	}
	
	public static function getTypeList()
	{
		global $wpdb;
		
		// Request
		$request = "SELECT pu.type FROM wp_nspublications pu GROUP BY pu.type";
		
		// Return
		return($wpdb->get_results($request));
	}
	
	public static function getSubjectList()
	{
		global $wpdb;
		
		// Request
		$request = "SELECT pu.term_id, te.name FROM wp_nspublications pu, wp_terms te WHERE pu.term_id = te.term_id GROUP BY pu.term_id";
		
		// Return
		return($wpdb->get_results($request));
	}
	
	/**
	 * Type of publications
	 */
	public static function typeToString($type)
	{
		switch($type)
		{
			case 0:
				return "Conference paper";
				break;
			case 1:
				return "Journal paper";
				break;
			case 2:
				return "Book";
				break;
			case 3:
				return "Master thesis";
				break;
			case 4:
				return "PhD thesis";
				break;
			case 5:
				return "Poster";
				break;
		}
	}
	
}
