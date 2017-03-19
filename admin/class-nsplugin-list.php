<?php

/**
 * The list-specific functionality of the plugin.
 * 
 * @file class-nsplugin-list.php
 * @brief Class Nsplugin_List used to display lists
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Import Wordpress list table object
require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

/**
 * @class	Nsplugin_List
 * @brief	List widget for admin menus
 */
class Nsplugin_List extends WP_List_Table
{
	/**
	 * @var		$m_aMenu
	 * @brief	Array containing menu's informations
	 */
	private $m_aMenu;
	
	/**
	 * @var		$m_sMenu
	 * @brief	
	 */
	private $m_sMenu;
	
	/**
	 * @var		$m_aFuncs
	 * @brief	
	 */
	private $m_aFuncs = array(	 'up' => 'move_up_record', 
								'down' => 'move_down_record', 
								'delete' => 'delete_record', 
								'update' => 'update_record', 
								'insert' => 'insert_record',
								'activate' => 'activate_record',
								'bulk-delete' => 'bulk_delete',
								'bulk-activate' => 'bulk_activate');
	
	/**
	 * @fvar	$m_aEqualOp
	 * @brief	Equal signes for each kind of database fields
	 */
	private $m_aEqualOp = array (	VARCHAR		=>	'like',
									NUM			=>	'=',
									DATE		=>	'like',
									ENUM		=>	'=');
	
	/**
	 * @var		$m_aSeps
	 * @brief	Separators for each kind of database fields
	 */
	private $m_aSeps = array(VARCHAR => '\'', NUM => '', DATE => '\'', ENUM => '\'');
	
	/**
	 * @var		$m_sIFField
	 * @brief	Field's name used to identify a row in the DB table.
	 */
	private $m_sIDField;
	
	/**
	 * @func	__construct
	 * @brief	Constructor
	 * @param	$menu Menu's name
	 * @param	$menu_obj Menu object
	 */
	function __construct($menu, $menu_obj)
	{
		global $status, $page;
		
		// Menu infos
		$this->m_sMenu = $menu;
		$this->m_aMenu = $menu_obj;
		$this->m_sIDField = $menu_obj['idfield'];
		
		// Set parents defaults
		parent::__construct(array(
			'singular' => 'record',
			'plural' => 'records',
			'ajax' => false
		));
	}
	
	/***********************************************************
	 * VIEWS AND FILTERS
	 ***********************************************************/
	
	/**
	 * @func	get_views
	 * @brief	Each possible values for the aggregate fields
	 * @return 	An array containing each possible values for the aggregate fields
	 */
	public function get_views()
	{
		global $wpdb;
		
		if(isset($this->m_aMenu['aggrfields']))
		{
			// Views
			$views = array();
			
			// All
			$allclass = (isset($_GET['aggr'])) ? '' : 'current';
			$views['all'] = __("<a href='?page=" . $_REQUEST['page'] . "' class=\"" . $allclass . "\">All</a>",'nsplugin');
			
			// For each field to aggregate
			foreach($this->m_aMenu['aggrfields'] as $field)
			{
				// Aggregate field & field info
				$fieldvalues = $this->aggregate_field($field);
				$field_infos = $this->m_aMenu['fields'][$field];
				
				// For each possible value
				foreach($fieldvalues as $value)
				{
					$val = $value->$field;
					$count = $value->counter;
					$class = (isset($_GET['aggr']) && $_GET['aggr'] == $field && $_GET['aggrval'] == $val) ? 'class="current"' : '';
					switch($field_infos['type'])
					{
						case NS_FORM_SELECT:
							$title = $field_infos['options'][$val];
							break;
						case NS_FORM_CATEGORY:
							$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms WHERE term_id = $val;");
							$title = $data[0]->name;
							break;
						default:
							$title = $val;
							break;
					}
					$views[$value->$field . $title] = __("<a href='?page=" . $_REQUEST['page'] . "&aggr={$field}&aggrval=$val' $class>$title</a> ($count)",'nsplugin');
				}
			}
			
			return $views;
		}
		return array();
	}
	
	/**
	 * @func	no_items
	 * @brief	What to display when there is no records.
	 */
	public function no_items()
	{
		_e('No records found');
	}
	
	/***********************************************************
	 * COLUMN DISPLAY
	 ***********************************************************/
	
	/**
	 * @func	text_column
	 * @brief	Display a column text
	 * @param	$item 
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function text_column($item, $column_name, $field)
	{
		// Get GUID
		if($field['null'] && $item->$column_name == "")
		{
			// Is null
			return "";
		}
		else
		{
			return sprintf('%1$s', substr($item->$column_name,0,$field['length']));
		}
	}
	
	/**
	 * @func	url_column
	 * @brief	Display a URL column
	 * @param	$item 
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function url_column($item, $column_name, $field)
	{
		// Get GUID
		if($field['null'] && $item->$column_name == "")
		{
			// Is null
			return "";
		}
		else
		{
			return sprintf('<a href="%1$s">%2$s</a>', $item->$column_name, substr($item->$column_name,0,$field['length']));
		}
	}
	
	/**
	 * @func	image_column
	 * @brief	Display an image column
	 * @param	$item
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function image_column($item, $column_name, $field)
	{
		global $wpdb;
		$id = $item->$column_name;
		
		// Get GUID
		if($field['null'] && $id == "")
		{
			return "";
		}
		else
		{
			$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = $id;");
			if(count($data) > 0)
			{
				$guid = $data[0]->guid;
				return sprintf("<img src=\"%s\" width=\"%d\" height=\"%d\"/>", $guid, $field['imagewidth'], $field['imageheight']);
			}
		}
		return "";
	}
	
	/**
	 * @func	category_column
	 * @brief	Display a category column
	 * @param	$item
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function category_column($item, $column_name, $field)
	{
		global $wpdb;
		$id = $item->$column_name;
		
		// Get GUID
		if($field['null'] && $id == "")
		{
			// Is null
			$name = "";
		}
		else
		{
			// Field should not be null
			$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms WHERE term_id = $id;");
			$name = $data[0]->name;
		}
		
		return sprintf('%1$s', $name);
	}
	
	/**
	 * @func	gallery_column
	 * @brief	Display a gallery column
	 * @param	$item
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function gallery_column($item, $column_name, $field)
	{
		global $wpdb;
		$id = $item->$column_name;
		
		// Get GID
		// Get GUID
		if($field['null'] && $id == "")
		{
			// Is null
			$name = "";
		}
		else
		{
			$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_gallery WHERE gallery_id = $id;");
			$name = $data[0]->gallery_name;
		}
		
		return sprintf('%1$s', $name);
	}
	
	/**
	 * @func	boolean_column
	 * @brief	Display a boolean column
	 * @param	$item
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function boolean_column($item, $column_name, $field)
	{
		// Get GUID
		if($field['null'] && $item->$column_name == "")
		{
			// Is null
			return "";
		}
		else
		{
			if($item->$column_name == 1)
				return '<input type="checkbox" name="' . $column_name . '" checked/>';
			else
				return '<input type="checkbox" name="' . $column_name . '"/>';
		}
	}
	
	/**
	 * @func	select_column
	 * @brief	Display a select column
	 * @param	$item
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function select_column($item, $column_name, $field)
	{
		// Get GUID
		if($field['null'] && $item->$column_name == "")
		{
			// Is null
			return "";
		}
		else
		{
			return sprintf('%1$s', $field['options'][$item->$column_name]);
		}
	}
	
	/**
	 * @func	color_column
	 * @brief	Display a color column
	 * @param	$item
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function color_column($item, $column_name, $field)
	{
		// Get GUID
		if($field['null'] && $item->$column_name == "")
		{
			// Is null
			return "";
		}
		else
		{
			return sprintf('<div style="background-color: %1$s; height: 40px; width: 40px; border: solid 1px #000;"></div>', $item->$column_name);
		}
	}
	
	/**
	 * @func	fontsize_column
	 * @brief	Display a font size column
	 * @param	$item
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function fontsize_column($item, $column_name, $field)
	{
		// Get GUID
		if($field['null'] && $item->$column_name == "")
		{
			// Is null
			return "";
		}
		else
		{
			$fontsize = $item->$column_name;
			return sprintf('<div style="font-size: %1$spx; font-weight: bold;">A</div>', $item->$column_name);
		}
	}
	
	/**
	 * @func	page_column
	 * @brief	Display a page column
	 * @param	$item 
	 * @param	$column_name
	 * @param	$field
	 * @return	String to display
	 */
	private function page_column($item, $column_name, $field)
	{
		global $wpdb;
		
		// ID
		$id = $item->$column_name;
		
		// Get GUID
		if($field['null'] && $id == "")
		{
			// Is null
			return "";
		}
		else
		{
			$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = $id;");
			$name = $data[0]->post_title;
			$url = $data[0]->guid;
			return sprintf('<a href="%1$s">%2$s</a>', $url, $name);
		}
	}
	
	/**
	 * @func	column_default
	 * @brief	Default column display
	 * @param	$item 
	 * @param	$column_name 
	 * @return	String to display
	 */
	public function column_default($item, $column_name)
	{
		global $adminMenus;
		$column = "";
		$actions = array();
		$content = "";
		
		// Get field infos
		$field = $this->m_aMenu['fields'][$column_name];
		
		// Main field?
		if($field['main'])
		{
			// Foreach action
			foreach($this->m_aMenu['rowactions'] as $action => $action_infos)
			{
				// If action set
				$action_url = "";
				$nonce_url = "";
				if($action_infos['url'])
				{
					// Action
					$action_url = "&action=" . esc_attr($action);
					
					// create a nonce
					$nonce_url = "&_wpnonce=" . wp_create_nonce('sp_' . $action . '_' . $this->m_sMenu);
				}
				
				// ID field
				$idfield = $this->m_aMenu['idfield'];
				
				$actions[$action] =  sprintf('<a href="?page=%s%s&%s=%s%s">%s</a>', esc_attr($action_infos['page']), $action_url, esc_attr($this->m_sMenu), absint($item->$idfield), $nonce_url, $action_infos['title']);
			}
		}
		
		// Column type
		switch($field['type'])
		{
			case NS_FORM_TEXT:
			case NS_FORM_TEXTAREA:
			case NS_FORM_DATE:
			case NS_FORM_NUMBER:
				$content = $this->text_column($item, $column_name, $field);
				break;
			case NS_FORM_SELECT:
				$content = $this->select_column($item, $column_name, $field);
				break;
			case NS_FORM_IMAGE:
				$content = $this->image_column($item, $column_name, $field);
				break;
			case NS_FORM_BOOLEAN:
				$content = $this->boolean_column($item, $column_name, $field);
				break;
			case NS_FORM_CATEGORY:
				$content = $this->category_column($item, $column_name, $field);
				break;
			case NS_FORM_GALLERY:
				$content = $this->gallery_column($item, $column_name, $field);
				break;
			case NS_FORM_URL:
				$content = $this->url_column($item, $column_name, $field);
				break;
			case NS_FORM_COLOR:
				$content = $this->color_column($item, $column_name, $field);
				break;
			case NS_FORM_FONTSIZE:
				$content = $this->fontsize_column($item, $column_name, $field);
				break;
			case NS_FORM_PAGE:
				$content = $this->page_column($item, $column_name, $field);
				break;
		}
		
		// Project's name content
		return sprintf('%1$s %2$s',
			$content,
			$this->row_actions($actions)
		);
	}
	
	/**
	 * @func	column_cb
	 * @brief	Display the checkbox column
	 * @param	$item
	 * @return	String to display
	 */
	protected function column_cb($item)
	{
		$idfield = $this->m_sIDField;
		return sprintf('<input type="checkbox" name="record[]" value="%s"/>', $item->$idfield);
	}
	
	/**
	 * @func	get_columns
	 * @brief	Dictates the table's columns and titles
	 * @return	String to display
	 */
	function get_columns()
	{
		// Start with a checkbox
		$columns = array('cb' => '<input type="checkbox" />');
		
		// For each fields
		foreach($this->m_aMenu['fields'] as $key => $field)
		{
			$columns[$key] = $field['title'];
		}
		
		return $columns;
	}
	
	/**
	 * @func	get_sortable_columns
	 * @brief	Get the sortable columns
	 * @return	Array $column_name => true/false
	 */
	function get_sortable_columns() 
	{
		$sortable_columns = array();
		
		// For each fields
		foreach($this->m_aMenu['fields'] as $key => $field)
		{
			if($field['sortable'])
				$sortable_columns[$key] = array($key,$field['sortable']);
		}
		
		return $sortable_columns;
	}
	
	/***********************************************************
	 * ACTIONS
	 ***********************************************************/
	
	/**
	 * @func	get_bulk_actions
	 * @brief	Return the bulk actions (Actions on the top)
	 * @return	Array containing the bulk actions
	 */
	function get_bulk_actions() 
	{
		return $this->m_aMenu['bulkactions'];
	}
	
	/**
	 * @func	check_action
	 * @brief	Check that an action is secured
	 * @param	$action The bulk action informations
	 * @return	true/false
	 */
	private function check_action($action)
	{
		// Get nonce
		$nonce = esc_attr($_REQUEST['_wpnonce']);
				
		// Check nonce
		if(array_key_exists($action, $this->m_aMenu['rowactions']) || $action == 'update' || $action == 'insert')
		{
			return wp_verify_nonce($nonce, 'sp_' . $action . '_' . $this->m_sMenu);
		}
		else
		{
			return wp_verify_nonce($nonce, 'bulk-records');
		}
	}
	
	/**
	 * @func	process_bulk_action
	 * @brief	Execute a bulk action
	 */
	function process_bulk_action() 
	{
		if(isset($_GET['action']))
		{
			// Check nonce
			if(!$this->check_action($this->current_action()))
			{
				die( 'Go get a life script kiddies' );
			}
			
			// Action
			$func = $this->m_aFuncs[$this->current_action()];
			$this->$func();
		}
	}
	
	/***********************************************************
	 * DB FUNCTIONS
	 ***********************************************************/
	
	/**
	 * @func	insert_record
	 * @brief	Insert data in DB
	 */
	private function insert_record()
	{
		global $_POST;
		global $wpdb;
		
		// Menu
		$menu_infos = $this->m_aMenu;
		
		// Check that field are here
		if(count($_POST) < count($menu_infos['fields']))
		{
			return;
		}
		
		// For each field
		$fields = "";
		$values = "";
		$count = 0;
		foreach($menu_infos['fields'] as $key => $field)
		{
			if(!isset($menu_infos['positionfield']) || $key != $menu_infos['positionfield'])
			{
				if(!$field['null'] || $_POST[$key] != "")
				{
					// Add to fields
					$fields .= $key;
					
					// Add to values
					if($field['type'] == NS_FORM_BOOLEAN && isset($_POST[$key]))
						$values .= $this->m_aSeps[$field['dbtype']] . '1' . $this->m_aSeps[$field['dbtype']];
					else if($field['type'] == NS_FORM_BOOLEAN)
						$values .= $this->m_aSeps[$field['dbtype']] . '0' . $this->m_aSeps[$field['dbtype']];
					/*else if($field['type'] == NS_FORM_SELECT)
						$values .= "'" . $this->m_aSeps[$field['dbtype']] . $_POST[$key] . $this->m_aSeps[$field['dbtype']] . "'";*/
					else
						$values .= $this->m_aSeps[$field['dbtype']] . $_POST[$key] . $this->m_aSeps[$field['dbtype']];
					
					// Commas
					$fields .= ',';
					$values .= ',';
				}
			}
		}
		
		// Position field
		if(isset($menu_infos['positionfield']))
		{
			// Max position
			$positionfield = $menu_infos['positionfield'];
			$data = $wpdb->get_results("SELECT max($positionfield) as max_pos FROM {$wpdb->prefix}{$menu_infos['table']};");
			$max = $data[0]->max_pos;
			$max += 1;
			$fields .= $positionfield;
			$values .= $max;
		}
		
		// Remove last comma for fields
		if(substr($fields,-1) == ',')
			$fields = substr($fields,0,strlen($fields)-1);
		
		// Remove last comma for value
		if(substr($values,-1) == ',')
			$values = substr($values,0,strlen($values)-1);
		
		// Request
		$request = "INSERT INTO {$wpdb->prefix}{$menu_infos['table']} ($fields) VALUES ($values);";
		
		// Send to MySQL
		$wpdb->query($request);
	}
	
	/**
	 * @func	update_record
	 * @brief	Update a record in the DB.
	 */
	private function update_record()
	{
		global $_POST;
		global $wpdb;
		
		// Menu
		$menu_infos = $this->m_aMenu;
		
		// ID field
		$idfield = $menu_infos['idfield'];
		
		// Check that field are here
		if(count($_POST) < count($menu_infos['fields']))
		{
			return;
		}
		
		// ID
		$ID = $_POST[$this->m_sMenu];
		
		// For each field
		$values = "";
		$count = 0;
		foreach($menu_infos['fields'] as $key => $field)
		{
			if(!isset($menu_infos['positionfield']) || $key != $menu_infos['positionfield'])
			{
				if(!$field['null'] || $_POST[$key] != "")
				{
					// Add to valuesif($field['type'] == NS_FORM_BOOLEAN && isset($_POST[$key]))
					if($field['type'] == NS_FORM_BOOLEAN && isset($_POST[$key]))
						$values .= $key . '=' . $this->m_aSeps[$field['dbtype']] . '1' . $this->m_aSeps[$field['dbtype']];
					else if($field['type'] == NS_FORM_BOOLEAN)
						$values .= $key . '=' . $this->m_aSeps[$field['dbtype']] . '0' . $this->m_aSeps[$field['dbtype']];
					/*else if($field['type'] == NS_FORM_SELECT)
						$values .= $key . '=' . "'" . $this->m_aSeps[$field['dbtype']] . $_POST[$key] . $this->m_aSeps[$field['dbtype']] . "'";*/
					else
						$values .= $key . '=' . $this->m_aSeps[$field['dbtype']] . $_POST[$key] . $this->m_aSeps[$field['dbtype']];
					
					// Comma
					$values .= ',';
				}
			}
		}
		
		// Remove last comma for value
		if(substr($values,-1) == ',')
			$values = substr($values,0,strlen($values)-1);
		
		// Request
		$request = "UPDATE {$wpdb->prefix}{$menu_infos['table']} SET $values WHERE $idfield = $ID;";
		
		// Send to MySQL
		$wpdb->query($request);
	}
	
	/**
	 * @func	get_record_status
	 * @brief	Get the status of a record (active field)
	 * @param	$ID Record's ID
	 * @return	Active field's value
	 */
	private function get_record_status($ID = -1)
	{
		global $wpdb;
		global $_GET;
		
		// ID
		if($ID == -1)
			$ID = $_GET[$this->m_sMenu];
		
		// Menu
		$menu_infos = $this->m_aMenu;
		
		// ID field
		$idfield = $menu_infos['idfield'];
		
		// Request
		return $wpdb->get_results("SELECT active FROM {$wpdb->prefix}{$menu_infos['table']} WHERE $idfield = $ID;")[0]->active;
	}
	
	/**
	 * @func	activate_record
	 * @brief	Activate a record (change active field's value)
	 * @param	$ID Record's ID
	 */
	private function activate_record($ID = -1)
	{
		global $wpdb;
		global $_GET;
		
		// ID
		if($ID == -1)
			$ID = $_GET[$this->m_sMenu];
		
		// Menu
		$menu_infos = $this->m_aMenu;
		
		// ID field
		$idfield = $menu_infos['idfield'];
		
		// Get current status
		$status = ($this->get_record_status($ID) == 0) ? 1 : 0;
		
		// Request
		$wpdb->query("UPDATE {$wpdb->prefix}{$menu_infos['table']} SET active = $status WHERE $idfield = $ID;");
	}
	
	/**
	 * @func	delete_record
	 * @brief	Delete a record by ID
	 * @param	$ID Record's ID to delete
	 */
	private function delete_record($ID = -1)
	{
		global $wpdb;
		global $_GET;
		
		// ID
		if($ID == -1)
			$ID = $_GET[$this->m_sMenu];
		
		// Menu
		$menu_infos = $this->m_aMenu;
		
		// ID field
		$idfield = $menu_infos['idfield'];
		
		// Request
		$wpdb->query("DELETE FROM {$wpdb->prefix}{$menu_infos['table']} WHERE $idfield = $ID;");
	}
	
	/**
	 * @func	bulk_delete
	 * @brief	Execute the delete bulk action
	 */
	private function bulk_delete()
	{
		global $_GET;
		
		// Foreach ID
		foreach($_GET['record'] as $ID)
		{
			$this->delete_record($ID);
		}
	}
	
	/**
	 * @func	bulk_activate
	 * @brief	Execute the activate bulk action
	 */
	private function bulk_activate()
	{
		global $_GET;
		
		// Foreach ID
		foreach($_GET['record'] as $ID)
		{
			$this->activate_record($ID);
		}
	}
	
	/**
	 * @func	move_up_record
	 * @brief	Move up entry
	 */
	private function move_up_record()
	{
		global $wpdb;
		global $_GET;
		
		// ID
		$ID = $_GET[$this->m_sMenu];
		
		// Menu
		$menu_infos = $this->m_aMenu;
		
		// ID field
		$idfield = $menu_infos['idfield'];
		
		// Position field
		$posfield = $menu_infos['positionfield'];
		
		// Min position
		$data = $wpdb->get_results("SELECT min($posfield) as min_pos FROM {$wpdb->prefix}{$menu_infos['table']};");
		$min = $data[0]->min_pos;
		
		// Current section data
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$menu_infos['table']} WHERE $idfield = $ID;")[0];
		$current_pos = $data->position;
		
		// If currently on the top, we do nothing
		if($current_pos != $min)
		{
			$wpdb->query("UPDATE {$wpdb->prefix}{$menu_infos['table']} SET $posfield = $current_pos WHERE $posfield = " . ($current_pos-1) . ";");
			$wpdb->query("UPDATE {$wpdb->prefix}{$menu_infos['table']} SET $posfield = " . ($current_pos-1) . " WHERE $idfield = $ID;");
		}
	}
	
	/**
	 * @func	move_down_record
	 * @brief	Move down entry
	 */
	private function move_down_record()
	{
		global $wpdb;
		global $_GET;
		
		// ID
		$ID = $_GET[$this->m_sMenu];
		
		// Menu
		$menu_infos = $this->m_aMenu;
		
		// ID field
		$idfield = $menu_infos['idfield'];
		
		// Position field
		$posfield = $menu_infos['positionfield'];
		
		// Max position
		$data = $wpdb->get_results("SELECT max($posfield) as max_pos FROM {$wpdb->prefix}{$menu_infos['table']};");
		$max = $data[0]->max_pos;
		
		// Current section data
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$menu_infos['table']} WHERE $idfield = $ID;")[0];
		$current_pos = $data->position;
		
		// If currently on the top, we do nothing
		if($current_pos != $max)
		{
			$wpdb->query("UPDATE {$wpdb->prefix}{$menu_infos['table']} SET $posfield = $current_pos WHERE $posfield = " . ($current_pos+1) . ";");
			$wpdb->query("UPDATE {$wpdb->prefix}{$menu_infos['table']} SET $posfield = " . ($current_pos+1) . " WHERE $idfield = $ID;");
		}
	}
	
	/**
	 * @func	record_count
	 * @brief	Count the result of a research
	 * @param	$search String to search
	 * @return	Record count for a research
	 */
	private function record_count($search = '')
	{
		global $wpdb;
		
		// Filter
		if($search != '' && isset($this->m_aMenu['researchfield']))
		{
			$search = trim($search);
			$researchfield = $this->m_aMenu['researchfield'];
			$dbtype = $this->m_aMenu['fields'][$researchfield]['dbtype'];
			$equalop = $this->m_aEqualOp[$dbtype];
			$seps = $this->m_aSeps[$dbtype];
			$plus = ($dbtype == VARCHAR) ? '%' : '';
			$sql = "SELECT count(*) FROM {$wpdb->prefix}{$this->m_aMenu['table']} WHERE {$this->m_aMenu['researchfield']} $equalop " . $seps . $plus . "$search" . $plus . $seps;
		}
		else
		{
			$sql = "SELECT count(*) FROM {$wpdb->prefix}{$this->m_aMenu['table']}";
		}
		
		return $wpdb->get_var($sql);
	}
	
	/**
	 * @func	get_records
	 * @brief	Get records
	 * @param	$per_page Records per page
	 * @param	$page_number Page to retrieve
	 * @param	$search String to research
	 * @return	Matching records
	 */
	private function get_records($per_page = 5, $page_number = 1, $search = '')
	{
		global $wpdb;
		
		// Aggregate
		if(isset($_GET['aggr']))
		{
			$aggrfield = $_GET['aggr'];
			$aggrdbtype = $this->m_aMenu['fields'][$aggrfield]['dbtype'];
			$aggrequalop = $this->m_aEqualOp[$aggrdbtype];
			$aggrseps = $this->m_aSeps[$aggrdbtype];
			$aggrsql = $aggrfield . ' ' . $aggrequalop . ' ' . $aggrseps . $_GET['aggrval'] . $aggrseps;
		}
		
		// Filter
		if($search != '' && isset($this->m_aMenu['researchfield']))
		{
			$search = trim($search);
			$researchfield = $this->m_aMenu['researchfield'];
			$dbtype = $this->m_aMenu['fields'][$researchfield]['dbtype'];
			$equalop = $this->m_aEqualOp[$dbtype];
			$seps = $this->m_aSeps[$dbtype];
			$plus = ($dbtype == VARCHAR) ? '%' : '';
			$sql = "SELECT * FROM {$wpdb->prefix}{$this->m_aMenu['table']} WHERE {$this->m_aMenu['researchfield']} $equalop " . $seps . $plus . "$search" . $plus . $seps;
			if(isset($aggrsql))
				$sql .= " AND $aggrsql";
		}
		else
		{
			$sql = "SELECT * FROM {$wpdb->prefix}{$this->m_aMenu['table']}";
			if(isset($aggrsql))
				$sql .= " WHERE $aggrsql";
		}
		
		// Order
		if(!empty($_REQUEST['orderby']))
		{
			$sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
			$sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : 'ASC';
		}
		else if(isset($this->m_aMenu['positionfield']))
		{
			$sql .= ' ORDER BY ' . $this->m_aMenu['positionfield'] . ' ASC';
		}
		else if(isset($this->m_aMenu['order']))
		{
			$sql .= ' ORDER BY ' . $this->m_aMenu['order'] . ' ' . $this->m_aMenu['asc'];
		}
		
		// Limit
		$sql .= " LIMIT $per_page";
		
		// OFFSET
		$sql .= " OFFSET " . ($page_number - 1) * $per_page;
		
		// Get
		$result = $wpdb->get_results($sql);
		
		return $result;
	}
	
	/**
	 * @func	aggregate_field
	 * @brief	Aggregate a field with the corresponding count
	 * @param	$field Field's name
	 * @return	Database result
	 */
	private function aggregate_field($field)
	{
		global $wpdb;
		$aggr = array();
		
		// Query
		$sql = "SELECT $field, count($field) as counter FROM {$wpdb->prefix}{$this->m_aMenu['table']} GROUP BY $field";
		
		// Get
		return $wpdb->get_results($sql);
	}
	
	/***********************************************************
	 * PREPARE ITEMS
	 ***********************************************************/
	
	/**
	 * @func	prepare_items
	 * @brief	Prepare the items for the list
	 * @param	$search String to search
	 */
	function prepare_items($search = '') 
	{
		global $wpdb;
		
		// Order
		$order = $this->m_aMenu['order'];
		$GLOBALS['order'] = $order;
		
		// Asc
		$asc = $this->m_aMenu['asc'];
		$GLOBALS['asc'] = $asc;
		
		// Records per page
		$per_page = 5;
		
		// Columns headers
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		
		// Handle bulk action
		$this->process_bulk_action();
		
		// Page informations
		$per_page			= $this->get_items_per_page('entry_per_page', 10);
		$current_page		= $this->get_pagenum();
		$total_items		= self::record_count($search);
		
		// Register pagination option and calculations
		$this->set_pagination_args(array(
			'total_items' => $total_items,                  //WE have to calculate the total number of items
			'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
			'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
		));
		
		// Items
		$this->items = self::get_records($per_page, $current_page, $search);
	}
}

?>
