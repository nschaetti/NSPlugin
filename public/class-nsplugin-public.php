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

/*
if(!class_exists('Nsplugin_Home_Section'))
{
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-home-section.php';
}
if(!class_exists('Nsplugin_Publication'))
{
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-publication.php';
}
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-education-entry.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-workexp-entry.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-awards-entry.php';
*/

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/public
 * @author     Nils Schaetti <n.schaetti@gmail.com>
 */
class Nsplugin_Public 
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	//private $m_sTitle = "";

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) 
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * @func	enqueue_scripts
	 * @brief	Register the stylesheets for the public-facing side of the site.
	 * @since	1.0.0
	 */
	public function enqueue_styles() 
	{
		// Add stylesheets for the public side
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nsplugin-public.css', array(), $this->version, 'all' );
	}

	/**
	 * @func	enqueue_scripts
	 * @brief	Register the JavaScript for the public-facing side of the site.
	 * @since	1.0.0
	 */
	public function enqueue_scripts() 
	{
		// Add public-side script of the site
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nsplugin-public.js', array( 'jquery' ), $this->version, false );
		
		// Add media
		wp_enqueue_media();
	}
    
    public function nsplugin_meta_tag_save()
    {
    }

}
