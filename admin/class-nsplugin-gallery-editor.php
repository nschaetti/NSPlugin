<?php

/******************************************
 * Author: Nils Schaetti
 * Copyright Nils Schaetti
 ******************************************/

/**
 * The gallery-specific functionality of the plugin.
 * 
 * @file class-nsplugin-gallery-editor.php
 * @brief Class Nsplugin_Gallery_Editor used to display a gallery editor
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

/**
 * @class	Nsplugin_Form_Generator
 * @brief	Form Generator
 */
class Nsplugin_Gallery_Editor
{
	/*********************************************************************/
	/**************************** VARIABLES ******************************/
	/*********************************************************************/
	
	/**
	 * @brief List of all fields in the DB tab
	 */
	private $m_aFields;
	
	/**
	 * @brief Menu's informations
	 */
	private $m_sPage;
	
	/**
	 * @brief
	 */
	private $m_sAction;
	
	/**
	 * @brief 
	 */
	private $m_sRequest;
	
	/**
	 * @brief
	 */
	private $m_iGalleryID;
	
	/**
	 * @var		$m_sTable
	 * @brief	Gallery's table
	 */
	private $m_sTable;
	
	/**
	 * @var		$m_iImagePerRow
	 * @brief	Image per row
	 */
	private $m_iImagePerRow;
	
	/******************************************************************/
	/*************************** FUNCTIONS ****************************/
	/******************************************************************/
	
	/**
	 * @func	__construct
	 * @brief	Constructor
	 * @param	$page
	 * @param	$action
	 * @param	$request
	 * @param	$entry_id
	 * @param	$additional_fields
	 */
	function __construct($page, $action, $request, $gallery_table, $gallery_id, $image_per_row = 6)
	{
		$this->m_aFields = array();
		$this->m_sPage = $page;
		$this->m_sAction = $action;
		$this->m_sRequest = $request;
		$this->m_iGalleryID = $gallery_id;
		$this->m_sTable = $gallery_table;
		$this->m_iImagePerRow = $image_per_row;
	}
	
	/*********************************************************************/
	/**************************** DISPLAY FUNCTIONS **********************/
	/*********************************************************************/
	
	/**
	 * @func	displayImagesTable
	 * @brief	Display gallery's images in a table
	 */
	private function displayImagesTable($images_per_row = 6)
	{
		// Get gallery's images
		$images = $this->get_records();
		
		// Nonce
		$nonce = wp_create_nonce('sp_remove_image_' . $this->m_sPage);
		
		// Images
		echo "<h2>Images</h2>";
		
		// Display in table
		?>
		<table style="width: 100%;">
		<?php
		
		// For each image
		$count = 1;
		foreach($images as $image)
		{
			// Row begin
			if($count % $images_per_row == 1)
			{
				echo "<tr>";
			}
			
			// Image
			?>
			<td style="width: 16.666%;">
				<a href="?page=<?php echo $this->m_sPage; ?>&action=remove_image&gallery=<?php echo $this->m_iGalleryID; ?>&post_id=<?php echo $image->ID; ?>&_wpnonce=<?php echo $nonce; ?>">
					<div class="ns-gallery-editor-image" style="background-image: url('<?php echo $image->guid; ?>');">
						<div class="ns-gallery-editor-image-hover" style="width: 100%; height: 200px;">
						</div>
					</div>
				</a>
			</td>
			<?php
			
			// Row end
			if($count % $images_per_row == 0)
			{
				echo "</tr>";
			}
			
			// Count
			$count++;
		}
		
		?>
		</table>
		<?php
	}
	
	/**
	 * @func	displayAddImageField
	 * @brief	Display the add image field
	 */
	private function displayAddImageField()
	{
		// Add image
		echo "<h2>Add image</h2>";
		
		// Nonce
		$nonce = wp_create_nonce('sp_add_image_' . $this->m_sPage);
		
		// Image field
		?>
		<form action="" method="get">
			<div class="image-preview-wrapper">
				<img src class="image-preview" id="image-preview-add-image" data-target="add-image" width="100" height="100" style="max-height: 100px; width: 100px;">
			</div>
			<input type="hidden" name="page" value="<?php echo $this->m_sPage; ?>"/>
			<input type="hidden" name="action" value="add_image"/>
			<input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>"/>
			<input type="hidden" name="gallery" value="<?php echo $this->m_iGalleryID; ?>"/>
			<input class="upload_image_button button" type="button" value="<?php _e( 'Upload image' ); ?>" data-target="add-image" />
			<input type="hidden" name="post_id" id="add-image" class="image_attachment_id" value="">
			<input class="button" type="submit" value="Add"/>
		</form>
		<?php
	}
	
	/**
	 * @func	Display
	 * @brief	Display the form
	 * @param	$nonce Challenge to add in the form
	 */
	public function Display($nonce, $images_per_row = 6)
	{
		// Check wpnonce
		if($this->check_action('images') || $this->check_action('remove_image') || $this->check_action('add_image'))
		{
			// Display images
			$this->displayImagesTable($images_per_row);
			
			// Display add image field
			$this->displayAddImageField();
		}
	}
	
	/***********************************************************************/
	/************************* DATABASE FUNCTIONS **************************/
	/***********************************************************************/
	
	/**
	 * @func	get_records
	 * @brief	Get gallery's images
	 * @return	Array of images' information
	 */
	private function get_records()
	{
		global $wpdb;
		
		// Get images
		$data = $wpdb->get_results("SELECT p.ID, p.guid FROM {$wpdb->prefix}{$this->m_sTable} g, {$wpdb->prefix}posts p WHERE g.post_id = p.ID AND g.gallery_id = {$this->m_iGalleryID};");
		
		return $data;
	}
	
	/**
	 * @func	delete_record
	 * @brief	
	 * @param	$post_id
	 */
	public function delete_record($post_id)
	{
		global $wpdb;
		
		// Check wpnonce
		if($this->check_action('remove_image'))
		{
			// Get images
			$data = $wpdb->query("DELETE FROM {$wpdb->prefix}{$this->m_sTable} WHERE gallery_id = {$this->m_iGalleryID} AND post_id = $post_id;");
		}
		else
		{
			echo "Try again script-kiddies!";
		}
	}
	
	/**
	 * @func	insert_record
	 * @brief	
	 * @param	$post_id
	 */
	public function insert_record($post_id)
	{
		global $wpdb;
		
		// Check wpnonce
		if($this->check_action('add_image'))
		{
			if(!$this->record_exists($post_id))
			{
				// Get images
				$data = $wpdb->query("INSERT INTO {$wpdb->prefix}{$this->m_sTable} (gallery_id,post_id) VALUES ({$this->m_iGalleryID},$post_id);");
			}
			else
			{
				echo "Sorry, this image is already in this gallery!";
			}
		}
		else
		{
			echo "Try again script-kiddies!";
		}
	}
	
	/**
	 * @func	record_exists
	 * @brief	Check that a record exists
	 * @param	$post_id Image post ID
	 * @return	True/false
	 */
	private function record_exists($post_id)
	{
		global $wpdb;
		
		// Get images
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$this->m_sTable} WHERE post_id = $post_id AND gallery_id = {$this->m_iGalleryID};");
		
		return count($data) > 0;
	}
	
	/*************************************************************************/
	/************************** SECURITY FUNCTIONS ***************************/
	/*************************************************************************/
	
	/**
	 * @func	check_action
	 * @brief	Check the challenge
	 * @oaran	$action Action to check
	 * @return	True or false
	 */
	private function check_action($action)
	{
		// Get nonce
		$nonce = esc_attr($_REQUEST['_wpnonce']);
				
		// Check nonce
		return wp_verify_nonce($nonce, 'sp_' . $action . '_' . $this->m_sPage);
	}
	
}

?>
