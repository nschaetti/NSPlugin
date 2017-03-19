<?php

 /**
 * The admin-specific functionality of the plugin.
 * 
 * @file		class-nsplugin-admin.php
 * @brief		Class Nsplugin_Admin for admin-specific functionality.
 * @link		http://www.nilsschaetti.com/
 * @since		1.0.0
 * @package		Nsplugin
 * @subpackage	Nsplugin/admin
 */

// Import the list generator.
require_once plugin_dir_path( dirname(__FILE__)) . 'admin/class-nsplugin-list.php';

// Import the form generator.
require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-nsplugin-form-generator.php';

// Import the gallery editor.
require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-nsplugin-gallery-editor.php';

// Import the terms editor.
require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-nsplugin-terms-editor.php';

// Import list of the admin menus.
require_once plugin_dir_path(dirname(__FILE__)) . 'admin/nsplugin-menus.php';

// Put menus in the global world.
$GLOBALS['adminMenus'] = $adminMenus;

/**
 * @class	Nsplugin_Admin
 * @brief	Class for admin functions
 * @since	1.0.0
 */
class Nsplugin_Admin 
{

	/**
	 * The ID of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param	string $plugin_name The name of this plugin.
	 * @param	string $version The version of this plugin.
	 */
	public function __construct($plugin_name, $version) 
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	
	/**
	 * Register settings
	 * 
	 * @since	1.0.0
	 */
	public function register_settings()
	{
		register_setting('nsplugin_settings', 'nsplugin_twitterlink');
		register_setting('nsplugin_settings', 'nsplugin_facebooklink');
		register_setting('nsplugin_settings', 'nsplugin_instagramlink');
		register_setting('nsplugin_settings', 'nsplugin_linkedinlink');
		register_setting('nsplugin_settings', 'nsplugin_youtubelink');
		register_setting('nsplugin_settings', 'nsplugin_scholarlink');
		register_setting('nsplugin_settings', 'nsplugin_rglink');
		register_setting('nsplugin_general_settings', 'nsplugin_theme');
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since	1.0.0
	 */
	public function enqueue_styles() 
	{
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nsplugin-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_style('wp-color-picker');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since	1.0.0
	 */
	public function enqueue_scripts() 
	{
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nsplugin-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-color-picker-alpha.js', array(), '1.2.2', false );
		wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( '/js/wp-color-picker-alpha.js',  __FILE__ ), array( 'wp-color-picker' ), '1.0.0', true );
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_media();
	}
	
	/**
	 * Add admin menu for the plugin.
	 *
	 * @since	1.0.0
	 */
	public function add_admin_menu()
	{
		global $adminMenus;
		
		// Add social links
		add_menu_page("Social networks", "Social networks", 'manage_options', 'sociallinks', array($this, 'menu_sociallinks'), 'dashicons-facebook');
		
		// Add parameters
		add_menu_page("Settings", "Settings", 'manage_options', 'settings', array($this, 'menu_settings'), 'dashicons-admin-settings');
		
		// Add admin menus
		foreach($adminMenus as $menu)
		{
			$hook = add_menu_page($menu["title"], $menu["title"], 'manage_options', $menu["id"], array($this, 'menu_' . $menu["id"]), $menu['dashicon']);
			add_action("load-$hook", array($this,'add_options'));
			foreach($menu["submenus"] as $submenu)
				add_submenu_page($menu["id"], $submenu["title"], $submenu["title"], 'manage_options',  $submenu["id"] . '_' . $menu["id"], array($this, 'menu_' . $submenu["id"] . '_' . $menu["id"]));
		}
	}
	
	/*******************************************************************
	 * MENUS FUNCTIONS
	 *******************************************************************/
	
	/**
	 * @func	menu_main
	 * @brief	Display admin home page
	 */
	public function menu_main()
	{
		echo '<h1>' . get_admin_page_title() . '</h1>';
		echo '<p>Bienvenue sur la page d\'accueil du plugin</p>';
	}
	
	/**
	 * @func	menu_sociallinks
	 * @brief	Display sociallinks admin page
	 */
	public function menu_sociallinks()
	{
		echo '<h1>'.get_admin_page_title().'</h1>';
		
		// New form
		$form = new Nsplugin_Form_Generator('sociallinks', '', $_REQUEST['page'], null, 'nsplugin_settings');
		
		// Action field
		$form->setActionField("options.php");
		
		// Fields
		$form->addField('nsplugin_twitterlink', NS_FORM_TEXT, 'Twitter', get_option('nsplugin_twitterlink'));
		$form->addField('nsplugin_facebooklink', NS_FORM_TEXT, 'Facebook', get_option('nsplugin_facebooklink'));
		$form->addField('nsplugin_instagramlink', NS_FORM_TEXT, 'Instagram', get_option('nsplugin_instagramlink'));
		$form->addField('nsplugin_linkedinlink', NS_FORM_TEXT, 'LinkedIn', get_option('nsplugin_linkedinlink'));
		$form->addField('nsplugin_youtubelink', NS_FORM_TEXT, 'YouTube', get_option('nsplugin_youtubelink'));
		$form->addField('nsplugin_scholarlink', NS_FORM_TEXT, 'Google Scholar', get_option('nsplugin_scholarlink'));
		$form->addField('nsplugin_rglink', NS_FORM_TEXT, 'Research Gate', get_option('nsplugin_rglink'));
		
		// Show widget
		$form->Display('');
	}
	
	public function menu_settings()
	{
		echo '<h1>'.get_admin_page_title().'</h1>';
		
		// New form
		$form = new Nsplugin_Form_Generator('settings', '', $_REQUEST['page'], null, 'nsplugin_general_settings');
		
		// Action field
		$form->setActionField("options.php");
		
		// Fields
		$form->addField('nsplugin_theme', NS_FORM_TEXT, 'Theme', get_option('nsplugin_theme'));
		
		// Show widget
		$form->Display('');
	}
	
	/**
	 * @func	add_options
	 * @brief	Add options
	 */
	public function add_options()
	{
		$option = 'per_page';
		$args = array(
				 'label' => 'Records',
				 'default' => 10,
				 'option' => 'records_per_page'
				 );
		add_screen_option( $option, $args );
	}
	
	/**
	 * @func	display_list
	 * @brief	Display the list of the menu
	 */
	private function display_list($menu, $menu_infos)
	{
		// Title
		echo '<h1>' . get_admin_page_title() . '</h1>';
		
		// Edit entry
		if(isset($_GET['action']) && $_GET['action'] == 'edit')
		{
			$this->menu_add_general($menu);
		}
		// Gallery actions
		else if(isset($_GET['action']) && ($_GET['action'] == 'images' || $_GET['action'] == 'remove_image' || $_GET['action'] == 'add_image'))
		{
			$this->menu_edit_gallery($menu, $menu_infos, $_GET['action'], (isset($_GET['post_id'])) ? $_GET['post_id'] : -1);
		}
		// Category actions
		else if(isset($_GET['action']) &&  ($_GET['action'] == 'terms' || $_GET['action'] == 'remove_term' || $_GET['action'] == 'add_term'))
		{
			$this->menu_edit_terms($menu, $menu_infos, $_GET['action'], (isset($_GET['term_id'])) ? $_GET['term_id'] : -1);
		}
        // Tags actions
		else if(isset($_GET['action']) &&  ($_GET['action'] == 'tags' || $_GET['action'] == 'remove_tag' || $_GET['action'] == 'add_tag'))
		{
			$this->menu_edit_tags($menu, $menu_infos, $_GET['action'], (isset($_GET['tag'])) ? $_GET['tag'] : "");
		}
		else
		{
			// Create table instance and prepare
			$listTable = new Nsplugin_List($menu, $menu_infos);
			
			// Fetch, prepare, sort and filter data
			if(isset($_POST['s']))
				$listTable->prepare_items($_POST['s']);
			else
				$listTable->prepare_items();
			
			// Display
			?><div style="padding-right: 20px;"><?php
				if(isset($menu_infos['researchfield']))
				{
					?><form method="post">
						<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
						<?php $listTable->search_box('Search Table', 'search'); ?>
					</form><?php
				}
				$listTable->views();
				?><form id="movies-filter" method="get">
					<!-- For plugins, we also need to ensure that the form posts back to our current page -->
					<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
					<!-- Now we can render the completed list table -->
					<?php $listTable->display() ?>
				</form>
			</div>
			<?php
		}
	}
	
	/***********************************************************
	 * MENUS FUNCTIONS
	 ***********************************************************/
	
	/**
	 * @func	admin_menu
	 * @brief	Dispatch action
	 */
	private function admin_menu($menu)
	{
		global $adminMenus;
		
		// Menu infos
		$menu_infos = $adminMenus[$menu];
		$this->display_list($menu, $menu_infos);
	}
	
	/**
	 * @func	menu_home
	 * @brief	Display home settings page
	 */
	public function menu_home()
	{
		$this->admin_menu("home");
	}
	
	/**
	 * @func	menu_headers
	 * @brief	Display header admin page
	 */
	public function menu_headers()
	{
		$this->admin_menu("headers");
	}
	
	/**
	 * @func	menu_headermenu
	 * @brief	Display the header menu page
	 */
	public function menu_headermenu()
	{
		$this->admin_menu("headermenu");
	}
	
	/**
	 * @func	menu_researches
	 * @brief	Display research admin page
	 */
	public function menu_researches()
	{
		$this->admin_menu("researches");
	}
	
	/**
	 * @func	menu_projects
	 * @brief	Display projects admin page
	 */
	public function menu_projects()
	{
		$this->admin_menu("projects");
	}
	
	/**
	 * @func	menu_publications
	 * @brief	Display publications admin page
	 */
	public function menu_publications()
	{
		$this->admin_menu("publications");
	}
	
	/**
	 * @func	menu_aboutme
	 * @brief	Display about admin page
	 */
	public function menu_aboutme()
	{
		$this->admin_menu("aboutme");
	}
	
	/**
	 * @func	menu_education
	 * @brief	Display education admin page
	 */
	public function menu_education()
	{
		$this->admin_menu("education");
	}
	
	/**
	 * @func	menu_workexp
	 * @brief	Display the page listening all the working experience
	 */
	public function menu_workexp()
	{
		$this->admin_menu("workexp");
	}
	
	/**
	 * @func	menu_awards
	 * @brief	Display the page listening all the awards
	 */
	public function menu_awards()
	{
		$this->admin_menu("awards");
	}
	
	/**
	 * @func	menu_languages
	 * @brief	Display the page for the languages
	 */
	public function menu_languages()
	{
		$this->admin_menu("languages");
	}
	
	/**
	 * @func	menu_hobbies
	 * @brief	Display the hobby page
	 */
	public function menu_hobbies()
	{
		$this->admin_menu("hobbies");
	}
	
	/**
	 * @func	menu_traites
	 * @brief	Display the personnal traits page
	 */
	public function menu_traits()
	{
		$this->admin_menu("traits");
	}
	
	/**
	 * @func	menu_achievements
	 * @brief	Display the achievements page
	 */
	public function menu_achievements()
	{
		$this->admin_menu("achievements");
	}
	
	/**
	 * @func	menu_gallery
	 * @brief	Display the gallery page
	 */
	public function menu_gallery()
	{
		$this->admin_menu("gallery");
	}
	
	/*******************************************************************
	 * ADD PAGES
	 *******************************************************************/
	
	/**
	 * @func	menu_add_general
	 * @brief	Display a add page
	 * @param	$menu Menu informations
	 */
	function menu_add_general($menu)
	{
		global $adminMenus;
		
		// Menu
		$menu_infos = $adminMenus[$menu];
		
		// Display form
		$this->display_form($menu, $menu_infos, (isset($_GET[$menu])) ? $_GET[$menu] : 0);
	}
	
	/**
	 * @func	display_form
	 * @brief	Display a form
	 * @param	$menu Menu's name
	 * @param	$menu_infos Menu's informations
	 * @param	$element_id Element's ID to display if in edit mode
	 */
	function display_form($menu, $menu_infos, $element_id = 0)
	{
		// Action
		$action = (isset($_GET[$menu])) ? 'update' : 'insert';
		
		// New form
		$form = new Nsplugin_Form_Generator($menu, $action, $_REQUEST['page'], (isset($element_id)) ? $element_id : null);
		
		// If action is edit, get the element
		if($action == 'update')
		{
			$menu_entry = $this->get_record($menu_infos, $element_id);
		}
		
		// Nonce
		$nonce = wp_create_nonce('sp_' . $action . '_' . $menu);
		
		// Add each fields
		foreach($menu_infos['fields'] as $key => $field)
		{
			$champs = $field['value'];
			$default = (isset($field['default'])) ? $field['default'] : '';
			$form->addField($key, $field['type'], $field['title'], (isset($menu_entry)) ? $menu_entry->$champs : $default, (isset($field['options'])) ? $field['options'] : null, (isset($field['formhidden'])) ? $field['formhidden'] : false, (isset($field['null'])) ? $field['null'] : false);
		}
		
		// Display
		$form->Display($nonce);
	}
	
	/**
	 * @func	menu_add_home
	 * @brief	Display add section page
	 */
	public function menu_add_home()
	{
		$this->menu_add_general("home");
	}
	
	/**
	 * @func	menu_add_headers
	 * @brief	Display add header page
	 */
	public function menu_add_headers()
	{
		$this->menu_add_general("headers");
	}
	
	/**
	 * @func	menu_add_headermenu
	 * @brief	Display the add header menu page
	 */
	public function menu_add_headermenu()
	{
		$this->menu_add_general("headermenu");
	}
	
	/**
	 * @func	menu_add_projects
	 * @brief	Display add project page
	 */
	public function menu_add_projects()
	{
		$this->menu_add_general("projects");
	}
	
	/**
	 * @func	menu_add_publications
	 * @brief	Display add publication page
	 */
	function menu_add_publications()
	{
		$this->menu_add_general("publications");
	}
	
	/**
	 * @func	menu_add_aboutme
	 * @brief	Display add aboutme page
	 */
	function menu_add_aboutme()
	{
		$this->menu_add_general("aboutme");
	}
	
	/**
	 * @func	menu_add_researches
	 * @brief	Menu add research
	 */
	function menu_add_researches()
	{
		$this->menu_add_general("researches");
	}
	
	/**
	 * @func	menu_add_education
	 * @brief	Display the page to add an education entry
	 */
	public function menu_add_education()
	{
		$this->menu_add_general("education");
	}
	
	/**
	 * @func	menu_add_workexp
	 * @brief	Display the page to add a working experience
	 */
	public function menu_add_workexp()
	{
		$this->menu_add_general("workexp");
	}
	
	/**
	 * @func	menu_add_awards
	 * @brief	Display the page to add an awards
	 */
	public function menu_add_awards()
	{
		$this->menu_add_general("awards");
	}
	
	/**
	 * @func	menu_add_languages
	 * @brief	Display the add language page
	 */
	public function menu_add_languages()
	{
		$this->menu_add_general("languages");
	}
	
	/**
	 * @func	menu_add_hobbies
	 * @brief	Display the add hobby page
	 */
	public function menu_add_hobbies()
	{
		$this->menu_add_general("hobbies");
	}
	
	/**
	 * @func	menu_add_traits
	 * @brief	Display the add trait page
	 */
	public function menu_add_traits()
	{
		$this->menu_add_general("traits");
	}
	
	/**
	 * @func	menu_add_achievements
	 * @brief	Display the add achievement page
	 */
	public function menu_add_achievements()
	{
		$this->menu_add_general("achievements");
	}
	
	/**
	 * @func	menu_add_gallery
	 * @brief	Display the add gallery page
	 */
	public function menu_add_gallery()
	{
		$this->menu_add_general("gallery");
	}
	
	/*******************************************************************
	 * EDIT GALLERY FUNCTIONS
	 *******************************************************************/
	
	/**
	 * @func	menu_edit_gallery
	 * @brief	Edit gallery's images
	 * @param	$menu Menu's name
	 * @param	$menu_infos Menu's informations
	 */
	private function menu_edit_gallery($menu, $menu_infos, $action, $post_id = -1)
	{
		// Nonce
		$nonce = wp_create_nonce('sp_' . $_GET['action'] . '_' . $menu);
		
		// New gallery editor
		$gallery_editor = new Nsplugin_Gallery_Editor($menu, $_GET['action'], $_REQUEST['page'], $menu_infos['gallerytable'], $_REQUEST['gallery']);
		
		// Delete the image
		if($action == 'remove_image' && $post_id != -1)
		{
			$gallery_editor->delete_record($post_id);
		}
		// Add an image
		else if($action == 'add_image' && $post_id != -1)
		{
			$gallery_editor->insert_record($post_id);
		}
		
		// Display
		$gallery_editor->Display($nonce);
	}
	
    /*******************************************************************
	 * EDIT TAGS FUNCTIONS
	 *******************************************************************/
    
    /**
	 * @func	menu_edit_tags
	 * @brief	Edit menu's linked tags
	 * @param	$menu Menu's name
	 * @param	$menu_infos Menu's informations
	 */
	private function menu_edit_tags($menu, $menu_infos, $action, $tag = "")
	{
		// Nonce
		$nonce = wp_create_nonce('sp_' . $_GET['action'] . '_' . $menu);
		
		// New terms editor
		$tags_editor = new Nsplugin_Tags_Editor($menu, $_GET['action'], $_REQUEST['page'], $menu_infos['tags_table'], $_REQUEST[$menu], $menu_infos['idfield']);
		
		// Remove a term
		if($action == 'remove_tag' && $tag != -1)
		{
			$tags_editor->delete_record($tag);
		}
		// Add a term
		else if($action == 'add_tag' && $tag != -1)
		{
			$tags_editor->insert_record($tag);
		}
		
		// Display
		$tags_editor->Display($nonce);
	}
    
	/*******************************************************************
	 * EDIT TERMS FUNCTIONS
	 *******************************************************************/
	
	/**
	 * @func	menu_edit_terms
	 * @brief	Edit menu's linked terms
	 * @param	$menu Menu's name
	 * @param	$menu_infos Menu's informations
	 */
	private function menu_edit_terms($menu, $menu_infos, $action, $term_id = -1)
	{
		// Nonce
		$nonce = wp_create_nonce('sp_' . $_GET['action'] . '_' . $menu);
		
		// New terms editor
		$terms_editor = new Nsplugin_Terms_Editor($menu, $_GET['action'], $_REQUEST['page'], $menu_infos['terms_table'], $_REQUEST[$menu], $menu_infos['idfield']);
		
		// Remove a term
		if($action == 'remove_term' && $term_id != -1)
		{
			$terms_editor->delete_record($term_id);
		}
		// Add a term
		else if($action == 'add_term' && $term_id != -1)
		{
			$terms_editor->insert_record($term_id);
		}
		
		// Display
		$terms_editor->Display($nonce);
	}
	
	/****** Extra category field ******/
	
	/**
	 * @func	save_extra_category_fields
	 * @brief	Save the extra fields in the category page
	 */
	public function save_extra_category_fields($term_id)
	{
		global $adminMenus;
		
		// For each menu
		foreach($adminMenus as $menu => $adminMenu)
		{
			// It is linked to terms
			if(array_key_exists("terms_table", $adminMenu))
			{
				// New terms editor
				$terms_editor = new Nsplugin_Terms_Editor($menu, '', '', $adminMenu['terms_table'], '', $adminMenu['idfield'], $adminMenu);
				
				// Dispay category extra field
				$terms_editor->saveCategoryExtraField($term_id);
			}
		}
		
		// Save media
		$this->save_media_category_field($term_id);
	}
	
	/**
	 * @func	extra_category_fields
	 * @brief	Add extra field to the category admin page
	 */
	public function extra_category_fields($tag)
	{
		global $adminMenus;
		
		// For each menu
		foreach($adminMenus as $menu => $adminMenu)
		{
			// It is linked to terms
			if(array_key_exists("terms_table", $adminMenu))
			{
				// New terms editor
				$terms_editor = new Nsplugin_Terms_Editor($menu, '', '', $adminMenu['terms_table'], '', $adminMenu['idfield'], $adminMenu);
				
				// Dispay category extra field
				$terms_editor->displayCategoryExtraField($tag);
			}
		}
		
		// Media
		$this->media_category_field($tag);
	}
	
	/******* MEDIA *******/
	
	/**
	 * @func	save_media_category_field
	 * @brief	Save the media field in the category admin page
	 */
	private function save_media_category_field($term_id)
	{
		// Save category media ID
		Nsplugin_Terms_Editor::save_media_category_field($term_id);
	}
	
	/**
	 * @func	media_category_field
	 * @brief	Add the media field to the category admin page
	 */
	private function media_category_field($tag)
	{
		Nsplugin_Terms_Editor::media_category_field($tag);
	}
	
	/*******************************************************************
	 * GET DATA FUNCTIONS
	 *******************************************************************/
	
	/**
	 * @func	get_record
	 * @brief	Get entry of a menu by ID
	 * @param	$menu_infos Menu's informations
	 * @param	$id Entry's ID
	 * @return	Record's array
	 */
	private function get_record($menu_infos, $id)
	{
		global $wpdb;
		
		// ID field
		$idfield = $menu_infos['idfield'];
		
		// Get section
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$menu_infos['table']} WHERE $idfield = $id;");
		return $data[0];
	}
	
	/*******************************************************************
	 * JAVASCRIPTS FUNCTIONS
	 *******************************************************************/
	
	/**
	 * @func	media_selector_print_scripts
	 * @brief	Add the image selection dialog
	 */
	function media_selector_print_scripts() 
	{
		$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
		?>
		<script type='text/javascript'>
			jQuery(document).ready( function( $ ) 
			{
				// Uploading files
				var file_frame;
				var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
				var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
				var target_input = '';
				
				jQuery('.upload_image_button').on('click', function( event )
				{
					event.preventDefault();
					
					// Target input
					target_input = $(this).data('target');
					console.log("target input : " + target_input);
					
					// If the media frame already exists, reopen it.
					if(file_frame) 
					{
						// Set the post ID to what we want
						file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
						// Open frame
						file_frame.open();
						return;
					} 
					else 
					{
						// Set the wp.media post id so the uploader grabs the ID we want when initialised
						wp.media.model.settings.post.id = set_to_post_id;
					}
					
					// Create the media frame.
					file_frame = wp.media.frames.file_frame = wp.media(
					{
						title: 'Select a image to upload',
						button: {
							text: 'Use this image',
						},
						multiple: false	// Set to true to allow multiple files to be selected
					});
					
					// When an image is selected, run a callback.
					file_frame.on( 'select', function() 
					{
						// We set multiple to false so only get one image from the uploader
						attachment = file_frame.state().get('selection').first().toJSON();
						
						// Do something with attachment.id and/or attachment.url here
						//$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
						$( '#image-preview-' + target_input).attr( 'src', attachment.url ).css( 'width', 'auto' );
						//$( '#image_attachment_id' ).val(attachment.id);
						console.log('#' + target_input);
						$( '#' + target_input).val(attachment.id);
						
						// Restore the main post ID
						wp.media.model.settings.post.id = wp_media_post_id;
					});
					
					// Finally, open the modal
					file_frame.open();
				});
				
				// Restore the main ID when the add media button is pressed
				jQuery( 'a.add_media' ).on( 'click', function() 
				{
					wp.media.model.settings.post.id = wp_media_post_id;
				});
				
				// Color picker
				//$('.wp-color-picker').wpColorPicker();
			});
		</script><?php
	}

}
