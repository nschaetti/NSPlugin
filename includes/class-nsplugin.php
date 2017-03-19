<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Nsplugin
 * @subpackage Nsplugin/includes
 * @author     Nils Schaetti <n.schaetti@gmail.com>
 */
class Nsplugin 
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Nsplugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() 
	{
		// Plugin's informations
		$this->plugin_name = 'nsplugin';
		$this->version = '1.0.0';
		
		// Load dependencies
		$this->load_dependencies();
		
		// Set locales
		$this->set_locale();
		
		// Define admin hooks
		$this->define_admin_hooks();
		
		// Define public hooks
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Nsplugin_Loader. Orchestrates the hooks of the plugin.
	 * - Nsplugin_i18n. Defines internationalization functionality.
	 * - Nsplugin_Admin. Defines all hooks for the admin area.
	 * - Nsplugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() 
	{
		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-nsplugin-loader.php';
		
		// The class responsible for defining internationalization functionality of the plugin.
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-nsplugin-i18n.php';
		
		// The class responsible for defining all actions that occur in the admin area.
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-nsplugin-admin.php';
		
		// The class responsible for defining all actions that occur in the public-facing side of the site.
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-nsplugin-public.php';
		
		// Load database objects
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-aboutfields.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-achievements.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-awards.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-education.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-gallery.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-headermenu.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-headers.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-home.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-hobbies.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-languages.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-projects.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-publications.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-researches.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-traits.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'db/class-nsplugin-workexp.php';
		
		// Plugin loader
		$this->loader = new Nsplugin_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Nsplugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() 
	{
		$plugin_i18n = new Nsplugin_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() 
	{
		// Admin part of the plugin
		$plugin_admin = new Nsplugin_Admin( $this->get_plugin_name(), $this->get_version() );
		
		// Register action
		$this->loader->add_action( 'admin_init',				$plugin_admin, 'register_settings');
		$this->loader->add_action( 'admin_enqueue_scripts',		$plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts',		$plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu',				$plugin_admin, 'add_admin_menu' );
		$this->loader->add_action( 'admin_footer',				$plugin_admin, 'media_selector_print_scripts' );
		
		// Register action for categories
		$this->loader->add_action( 'edit_category_form_fields',	$plugin_admin, 'extra_category_fields');
		$this->loader->add_action( 'edited_category',			$plugin_admin, 'save_extra_category_fields');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() 
	{
		// Public part of the plugin
		$plugin_public = new Nsplugin_Public( $this->get_plugin_name(), $this->get_version() );
		
		// Register public action
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		/*$this->loader->add_action( 'nsplugin_get_sociallink', $plugin_public, 'get_sociallink' );
		$this->loader->add_action( 'nsplugin_category_list', $plugin_public, 'get_category_list' );
		$this->loader->add_action( 'nsplugin_projects_list', $plugin_public, 'get_projects_list' );
		$this->loader->add_action( 'nsplugin_research_list', $plugin_public, 'get_research_list' );
		$this->loader->add_action( 'nsplugin_get_about_field', $plugin_public, 'get_about_field' );
		$this->loader->add_action( 'nsplugin_main_header_guid', $plugin_public, 'get_main_header_guid' );
		$this->loader->add_action( 'nsplugin_main_header_desc', $plugin_public, 'get_main_header_desc' );
		$this->loader->add_action( 'nsplugin_main_header_link', $plugin_public, 'get_main_header_link' );
		$this->loader->add_action( 'nsplugin_get_headers_json', $plugin_public, 'get_headers_json');
		$this->loader->add_action( 'nsplugin_get_section_array', $plugin_public, 'get_section_array');
		$this->loader->add_action( 'nsplugin_show_education', $plugin_public, 'show_education');
		$this->loader->add_action( 'nsplugin_show_working_experiences', $plugin_public, 'show_working_experiences');
		$this->loader->add_action( 'nsplugin_show_awards', $plugin_public, 'show_awards');*/
		
		// Posts tag
		$this->loader->add_action( 'edit_post', $plugin_public, 'nsplugin_meta_tag_save');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() 
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() 
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Nsplugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() 
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() 
	{
		return $this->version;
	}

}
