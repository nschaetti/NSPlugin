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

class Nsplugin_Workexp_Entry
{
	/********************************************
	 * VARIABLES
	 ********************************************/
	
	public $m_iID;
	
	public $m_sPosition;
	
	public $m_sCompany;
	
	public $m_sAddress;
	
	public $m_sCountry;
	
	public $m_sURL;
	
	public $m_iMID;
	
	public $m_sGUID;
	
	public $m_sHonors;
	
	public $m_sDescription;
	
	public $m_dBegin;
	
	public $m_dEnd;
	
	public $m_iDuration;
	
	/********************************************
	 * CONSTRUCTOR FUNCTIONS
	 ********************************************/
	
	/**
	 * Constructor
	 */
	function __construct($id, $position, $company, $address, $country, $url, $mid, $guid, $honors, $description, $begin, $end, $duration)
	{
		$this->m_iID = $id;
		$this->m_sPosition = $position;
		$this->m_sCompany = $company;
		$this->m_sAddress = $address;
		$this->m_sCountry = $country;
		$this->m_sURL = $url;
		$this->m_sMID = $mid;
		$this->m_sGUID = $guid;
		$this->m_sHonors = $honors;
		$this->m_sDescription = $description;
		$this->m_dBegin = $begin;
		$this->m_dEnd = $end;
		$this->m_iDuration = $duration;
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
		
		//$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; width: 780px;\"><a href=\"{$this->m_sURL}\" style=\"color: #000;\"><h1 style=\"color: #000; margin: 0; padding: 0; font-size: 17px; line-height: 17px;\">{$this->m_sCompany}</a>, {$this->m_sAddress} ({$this->m_sCountry})</h1></div>";
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; width: 780px;\"><h1 style=\"color: #000; margin: 0; padding: 0; font-size: 17px; line-height: 17px;\">{$this->m_sPosition}</h1></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 7px; width: 880px;\"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px;\"><a href=\"{$this->m_sURL}\" style=\"color: #000;\">{$this->m_sCompany}</a>, {$this->m_sAddress} ({$this->m_sCountry})</h2></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 2px; \"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px; color: #666;\">{$this->m_dBegin->format('Y')} - {$this->m_dEnd->format('Y')} ({$this->m_iDuration} years)</h2></div>";
		
		$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 7px; width: 880px;\"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 22px; color: #666;\">{$this->m_sHonors}</h2></div>";
		
		if($this->m_sDescription)
			$code .= "<div style=\"float: left; padding: 2px; padding-left: 20px; padding-bottom: 7px; width: 880px;\"><h2 style=\"margin: 0; padding: 0; font-size: 14px; font-weight: normal; line-height: 14px; color: #666;\">{$this->m_sDescription}</h2></div>";
		
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
		$work_array = array();
		
		// Request
		$request = "SELECT * FROM {$wpdb->prefix}nsworkexp w, {$wpdb->prefix}posts p WHERE w.mid = p.ID ";
		
		// ORDER
		$request .= " ORDER BY $orderby $order";
		
		// Limit
		if($limit != -1)
			$request .= " LIMIT $limit";
		
		// Get all sections
		$request .= ";";
		$works = $wpdb->get_results($request);
		
		// For each of those
		foreach($works as $work)
		{
			array_push($work_array, new Nsplugin_Workexp_Entry($work->id, $work->position, $work->company, $work->address, $work->country, $work->url, $work->mid, $work->guid, $work->honors, $work->description, DateTime::createFromFormat("Y-m-d", $work->begin), DateTime::createFromFormat("Y-m-d", $work->end), $work->duration));
		}
		
		return $work_array;
	}
	
}
