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

/**
 * @class Nsplugin_Education_Entry
 */
class Nsplugin_Education_Entry
{
	/********************************************
	 * VARIABLES
	 ********************************************/
	
	/**
	 * @var $m_iID
	 */
	public $m_iID;
	
	public $m_sDegree;
	
	public $m_sCollege;
	
	public $m_sCountry;
	
	public $m_sURL;
	
	public $m_iMID;
	
	public $m_sGUID;
	
	public $m_sMajor;
	
	public $m_sMinor;
	
	public $m_dBegin;
	
	public $m_dEnd;
	
	public $m_sHonors;
	
	public $m_sDescription;
	
	/********************************************
	 * CONSTRUCTOR FUNCTIONS
	 ********************************************/
	
	/**
	 * Constructor
	 */
	function __construct($id, $degree, $college, $country, $url, $mid, $guid, $major, $minor, $begin, $end, $honors, $description)
	{
		$this->m_iID = $id;
		$this->m_sDegree = $degree;
		$this->m_sCollege = $college;
		$this->m_sCountry = $country;
		$this->m_sURL = $url;
		$this->m_iMID = $mid;
		$this->m_sGUID = $guid;
		$this->m_sMajor = $major;
		$this->m_sMinor = $minor;
		$this->m_dBegin = $begin;
		$this->m_dEnd = $end;
		$this->m_sHonors = $honors;
		$this->m_sDescription = $description;
	}
	
	/*******************************************
	 * FUNCTIONS
	 *******************************************/
	 
	/**
	 * Display the publication
	 */
	public function Display()
	{
		$code = '<li style="margin-bottom: 15px;">';
		
		// Image
		$code .= "<div style=\"float: left;\"><div style=\"height: 70px; width: 90px; background-image: url({$this->m_sGUID}); background-color: #fff; background-size: contain; background-position: center; background-repeat: no-repeat;\"></div></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; width: 780px;\"><a href=\"{$this->m_sURL}\" style=\"color: #000;\"><h1 style=\"color: #000; margin: 0; padding: 0; font-size: 17px; line-height: 17px;\">{$this->m_sCollege}</a>, {$this->m_sCountry}</h1></div>";
		
		$minor = $this->m_sMinor != "" ? " (" . $this->m_sMinor . ")" : $this->m_sMinor;
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 7px; width: 880px;\"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px;\">{$this->m_sDegree}, {$this->m_sMajor} $minor</h2></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; \"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px; color: #666;\">{$this->m_dBegin->format('Y')} - {$this->m_dEnd->format('Y')}</h2></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; width: 880px;\"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 22px; color: #666;\">{$this->m_sHonors}</h2></div>";
		
		if($this->m_sDescription)
			$code .= "<div style=\"margin-left: 90px; float: left; padding: 2px; padding-left: 20px; padding-bottom: 7px; width: 880px;\"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px; color: #222;\">{$this->m_sDescription}</h2></div>";
		
		$code .= "<div style=\"clear: both;\"></div>";
		
		$code .= '</li>';
		
		echo $code;
	}
	
	/*******************************************
	 * STATIC FUNCTIONS
	 *******************************************/
	
	public static function Load($limit = -1, $orderby = "end", $order = "desc")
	{
		global $wpdb;
		$edu_array = array();
		
		// Request
		$request = "SELECT * FROM {$wpdb->prefix}nseducation e, {$wpdb->prefix}posts po WHERE e.mid = po.ID ";
		
		// ORDER
		$request .= " ORDER BY $orderby $order";
		
		// Limit
		if($limit != -1)
			$request .= " LIMIT $limit";
		
		// Get all sections
		$request .= ";";
		$entries = $wpdb->get_results($request);
		
		// For each of those
		foreach($entries as $entry)
		{
			array_push($edu_array, new Nsplugin_Education_Entry($entry->id, $entry->degree, $entry->college, $entry->country, $entry->url, $entry->mid, $entry->guid, $entry->major, $entry->minor, DateTime::createFromFormat("Y-m-d", $entry->begin), DateTime::createFromFormat("Y-m-d", $entry->end), $entry->honors, $entry->description));
		}
		
		return $edu_array;
	}
	
}
