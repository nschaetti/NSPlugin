<?php

/******************************************
 * Author: Nils Schaetti
 * Copyright Nils Schaetti
 ******************************************/

/**
 * The term-specific functionality of the plugin.
 * 
 * @file class-nsplugin-terms-editor.php
 * @brief Class Nsplugin_Terms_Editor used to display a terms editor
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
class Nsplugin_Terms_Editor
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
	private $m_iID;
	
	/**
	 * @var		$m_sTable
	 * @brief	Terms' table
	 */
	private $m_sTable;
	
	/**
	 * @var		$m_iIDField
	 * @brief	ID Field
	 */
	private $m_iIDField;
	
	/**
	 * @var		$m_aMenuInfos
	 * @brief	Menu's infos
	 */
	private $m_aMenuInfos;
	
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
	function __construct($page, $action, $request, $terms_table, $id, $idfield, $menuInfos = array())
	{
		$this->m_aFields = array();
		$this->m_sPage = $page;
		$this->m_sAction = $action;
		$this->m_sRequest = $request;
		$this->m_iID = $id;
		$this->m_sTable = $terms_table;
		$this->m_iIDField = $idfield;
		$this->m_aMenuInfos = $menuInfos;
	}
	
	/*********************************************************************/
	/**************************** DISPLAY FUNCTIONS **********************/
	/*********************************************************************/
	
	/**
	 * @func	displayMenuCategories
	 * @brief	Display menu's categories
	 */
	private function displayMenuCategories()
	{
		// Get menu's categories
		$terms = $this->get_records();
		
		// Nonce
		$nonce = wp_create_nonce('sp_remove_term_' . $this->m_sPage);
		
		// Title
		echo "<h2>Categories</h2>";
		
		// For each category
		foreach($terms as $term)
		{
            if($term->taxonomy == "category")
            {
                ?>
                <span class="ns-terms-editor-term">
                    <?php echo $term->name; ?> - 
                    <a href="?page=<?php echo $this->m_sPage; ?>&action=remove_term&<?php echo $this->m_sPage; ?>=<?php echo $this->m_iID; ?>&term_id=<?php echo $term->term_id; ?>&_wpnonce=<?php echo $nonce; ?>">
                        Delete
                    </a>
                </span>
                <?php
            }
		}
	}
    
    /**
	 * @func	displayMenuTags
	 * @brief	Display menu's Tags
	 */
	private function displayMenuTags()
	{
		// Get menu's categories
		$terms = $this->get_records();
		
		// Nonce
		$nonce = wp_create_nonce('sp_remove_term_' . $this->m_sPage);
		
		// Title
		echo "<h2>Tags</h2>";
		
		// For each category
		foreach($terms as $term)
		{
			if($term->taxonomy == "post_tag")
            {
                ?>
                <span class="ns-terms-editor-term">
                    <?php echo $term->name; ?> - 
                    <a href="?page=<?php echo $this->m_sPage; ?>&action=remove_term&<?php echo $this->m_sPage; ?>=<?php echo $this->m_iID; ?>&term_id=<?php echo $term->term_id; ?>&_wpnonce=<?php echo $nonce; ?>">
                        Delete
                    </a>
                </span>
                <?php
            }
		}
	}
	
	/**
	 * @func	displayAddCategoryField
	 * @brief	Display  the field to add a category
	 */
	private function displayAddCategoryField()
	{
		// Title
		echo "<h2>Add a category</h2>";
		
		// Get all terms
		$terms = $this->get_terms();
		
		// Nonce
		$nonce = wp_create_nonce('sp_add_term_' . $this->m_sPage);
		
		?>
		<form action="" method="get">
			<select name="term_id">
				<?php
				foreach($terms as $term)
				{
					?>
					<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?> (<?php echo $term->taxonomy ?>)</option>
					<?php
				}
				?>
			</select>
			<input type="hidden" name="page" value="<?php echo $this->m_sPage; ?>"/>
			<input type="hidden" name="<?php echo $this->m_sPage; ?>" value="<?php echo $this->m_iID; ?>"/>
			<input type="hidden" name="action" value="add_term"/>
			<input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>"/>
			<input type="hidden" name="id" value="<?php echo $this->m_iID; ?>"/>
			<input class="button" type="submit" value="Add"/>
		</form>
		<?php
	}
	
	/**
	 * @func	Display
	 * @brief	Display the form
	 * @param	$nonce Challenge to add in the form
	 */
	public function Display($nonce)
	{
		// Check wpnonce
		if($this->check_action('terms') || $this->check_action('remove_term') || $this->check_action('add_term'))
		{
			// Display menu's categories
			$this->displayMenuCategories();
            
            // Display menu's tags
			$this->displayMenuTags();
			
			// Display add category field
			$this->displayAddCategoryField();
		}
	}
	
	/**
	 * @func	media_category_field
	 * @brief	Add the media field to the category admin page
	 */
	public function displayCategoryExtraField($tag)
	{
		global $wpdb;
		
		// Linked to this term
		$linked_records = $this->get_all_linked_records();
		
		// Fields
		$display_field = $this->m_aMenuInfos['display_field'];
		$idfield = $this->m_iIDField;
		
		// Begin
		?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="category-<?php echo $this->m_sPage; ?>"><?php echo $this->m_aMenuInfos['title']; ?></label>
				</th>
				<td>
					<?php
						foreach($linked_records as $linked_record)
						{
							$checked = "";
							if($this->record_exists($tag->term_id, $linked_record->$idfield))
								$checked = "checked";
							
							// Display checkbox
							echo '<input name="' . $this->m_sPage . '_' . $linked_record->$idfield . '" type="checkbox" ' . $checked . '/> ' . $linked_record->$display_field . '<br/>';
						}
					?>
					<div style="height: 8px;"></div>
					<span class="description">Select <?php echo $this->m_sPage; ?> linked to this category.</span>
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func	media_category_field
	 * @brief	Add the media field to the category admin page
	 */
	public static function media_category_field($tag)
	{
		global $wpdb;
		
		// Term meta
		$term_media = get_term_meta($tag->term_id, 'term_media');
		
		// Post object
		if(count($term_media) > 0)
		{
			$media = get_post($post = $term_media[0]);
		}
		
		// Begin
		?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="category-media">Media</label>
				</th>
				<td>
					<div class="image-preview-wrapper">
						<img src="<?php echo (isset($media)) ? $media->guid : ''; ?>" class="image-preview" id="image-preview-category-media" data-target="category-media" width="100" height="100" style="max-height: 100px; width: 100px;">
					</div>
					<input class="upload_image_button button" type="button" value="<?php _e( 'Upload image' ); ?>" data-target="category-media"/>
					<input type="hidden" name="category-media" id="category-media" class="image_attachment_id" value="<?php echo (count($term_media) > 0) ? $term_media[0] : "0"; ?>">
					<div style="height: 8px;"></div>
					<span class="description">Select a media for the category</span>
				</td>
			</tr>
		<?php
	}
	
	/***********************************************************************
	 **************************** SAVE EXTRA FIELD *************************
	 ***********************************************************************/
	
	/**
	 * @func	
	 * @brief	
	 */
	public function saveCategoryExtraField($term_id)
	{
		global $wpdb;
		
		// Delete each records
		$wpdb->query("DELETE FROM {$wpdb->prefix}{$this->m_sTable} WHERE term_id = $term_id;");
		
		// For each POST variables
		foreach($_POST as $key => $value)
		{
			if(strstr($key,$this->m_sPage . "_") !== false)
			{
				// ID
				$id = str_replace($this->m_sPage . "_", "", $key);
				
				// If not already here
				if(!$this->record_exists($term_id, $id))
				{
					// Insert
					$wpdb->query("INSERT INTO {$wpdb->prefix}{$this->m_sTable} ({$this->m_iIDField},term_id) VALUES ($id,$term_id);");
				}
			}
		}
	}
	
	/**
	 * @func	save_media_category_field
	 * @brief	Save the media field in the category admin page
	 */
	public static function save_media_category_field($term_id)
	{
		// Save category media ID
		update_term_meta($term_id, 'term_media', $_POST['category-media']);
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
		return $wpdb->get_results("SELECT t.term_id, t.name, ta.taxonomy taxonomy FROM {$wpdb->prefix}{$this->m_sTable} x, {$wpdb->prefix}terms t, {$wpdb->prefix}term_taxonomy ta WHERE x.{$this->m_iIDField} = {$this->m_iID} AND x.term_id = t.term_id AND t.term_id = ta.term_id;");
	}
	
	/**
	 * @func	get_terms
	 * @brief
	 */
	private function get_terms()
	{
		global $wpdb;
		
		// Get terms
		return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms te, {$wpdb->prefix}term_taxonomy ta WHERE te.term_id = ta.term_id ORDER BY ta.taxonomy;");
	}
	
	/**
	 * @func	
	 * @brief	
	 */
	private function get_records_by_term_id($term_id)
	{
		global $wpdb;
		
		// Get images
		return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$this->m_sTable} WHERE term_id = $term_id;");
	}
	
	/**
	 * @func	
	 * @brief	
	 */
	private function get_all_linked_records()
	{
		global $wpdb;
		
		// Linked table
		$linked_table = $this->m_aMenuInfos['table'];
		
		// Get images
		return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$linked_table};");
	}
	
	/**
	 * @func	delete_record
	 * @brief	
	 * @param	$post_id
	 */
	public function delete_record($term_id)
	{
		global $wpdb;
		
		// Check wpnonce
		if($this->check_action('remove_term'))
		{
			// Get images
			$wpdb->query("DELETE FROM {$wpdb->prefix}{$this->m_sTable} WHERE {$this->m_iIDField} = {$this->m_iID} AND term_id = $term_id;");
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
	public function insert_record($term_id, $id = null)
	{
		global $wpdb;
		
		// Check wpnonce
		if($this->check_action('add_term'))
		{
			if(!$this->record_exists($term_id, $id))
			{
				// Get term
				if($id == null)
				{
					$wpdb->query("INSERT INTO {$wpdb->prefix}{$this->m_sTable} ({$this->m_iIDField},term_id) VALUES ({$this->m_iID},$term_id);");
				}
				else
				{
					$wpdb->query("INSERT INTO {$wpdb->prefix}{$this->m_sTable} ({$this->m_iIDField},term_id) VALUES ($id,$term_id);");
				}
			}
			else
			{
				echo "Sorry, this term is already linked!";
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
	private function record_exists($term_id, $id = null)
	{
		global $wpdb;
		
		// Get images
		if($id == null)
			$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$this->m_sTable} WHERE term_id = $term_id AND {$this->m_iIDField} = {$this->m_iID};");
		else
			$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}{$this->m_sTable} WHERE term_id = $term_id AND {$this->m_iIDField} = $id;");
		
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
