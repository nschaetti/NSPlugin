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

class Nsplugin_Awards_Entry
{
	/********************************************
	 * VARIABLES
	 ********************************************/
	
	public $m_iID;
	
	public $m_sTitle;
	
	public $m_sSource;
	
	public $m_sSourceURL;
	
	public $m_dDate;
	
	public $m_sReason;
	
	public $m_sReasonURL;
	
	public $m_iMID;
	
	public $m_sGUID;
	
	/********************************************
	 * CONSTRUCTOR FUNCTIONS
	 ********************************************/
	
	/**
	 * Constructor
	 */
	function __construct($id, $title, $source, $sourceurl, $date, $reason, $reasonurl, $mid, $guid)
	{
		$this->m_iID = $id;
		$this->m_sTitle = $title;
		$this->m_sSource = $source;
		$this->m_sSourceURL = $sourceurl;
		$this->m_dDate = $date;
		$this->m_sReason = $reason;
		$this->m_sReasonURL = $reasonurl;
		$this->m_iMID = $mid;
		$this->m_sGUID = $guid;
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
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; width: 780px;\"><h1 style=\"margin: 0; padding: 0; font-size: 17px; line-height: 17px;\">{$this->m_sTitle}</h1></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 7px; width: 880px;\"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px;\"><a href=\"{$this->m_sSourceURL}\" style=\"\">{$this->m_sSource}</a>, <a href=\"{$this->m_sReasonURL}\">{$this->m_sReason}</a></h2></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; \"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px; color: #888;\">{$this->m_dDate->format('Y')}</h2></div>";
		
		$code .= "<div style=\"clear: both;\"></div>";
		
		$code .= '</li>';
		
		echo $code;
	}
	
	/*******************************************
	 * STATIC FUNCTIONS
	 *******************************************/
	
	public static function Load($limit = -1, $orderby = "date", $order = "desc")
	{
		global $wpdb;
		$awards_array = array();
		
		// Request
		$request = "SELECT * FROM {$wpdb->prefix}nsawards a, {$wpdb->prefix}posts p WHERE a.mid = p.ID ";
		
		// ORDER
		$request .= " ORDER BY $orderby $order";
		
		// Limit
		if($limit != -1)
			$request .= " LIMIT $limit";
		
		// Get all sections
		$request .= ";";
		$awards = $wpdb->get_results($request);
		
		// For each of those
		foreach($awards as $award)
		{
			array_push($awards_array, new Nsplugin_Awards_Entry($award->id, $award->title, $award->source, $award->source_url, DateTime::createFromFormat("Y-m-d", $award->date), $award->reason, $award->reason_url, $award->mid, $award->guid));
		}
		
		return $awards_array;
	}
	
}
