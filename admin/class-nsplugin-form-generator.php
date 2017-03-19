<?php

/******************************************
 * Author: Nils Schaetti
 * Copyright Nils Schaetti
 ******************************************/

/**
 * The form-specific functionality of the plugin.
 * 
 * @file class-nsplugin-form-generator.php
 * @brief Class Nsplugin_Form_Generator used to display a complex form
 *
 * @link       http://www.nilsschaetti.com/
 * @since      1.0.0
 *
 * @package    Nsplugin
 * @subpackage Nsplugin/admin
 */

// Fields type
define("NS_FORM_TEXT",		0);				// Text field
define("NS_FORM_TEXTAREA",	1);				// Text area field
define("NS_FORM_DATE",		2);				// Date field
define("NS_FORM_IMAGE",		3);				// Image field
define("NS_FORM_SELECT",	4);				// SELECT field
define("NS_FORM_CATEGORY",	5);				// Select category field
define("NS_FORM_BOOLEAN",	6);				// Checkbox field
define("NS_FORM_URL",		7);				// Text URL field
define("NS_FORM_GALLERY",	8);				// Select gallery field
define("NS_FORM_COLOR",		9);				// Color dialog box field
define("NS_FORM_FONTSIZE",	10);			// Font size dialog box field
define("NS_FORM_NUMBER",	11);			// Number field
define("NS_FORM_PAGE",		12);			// Select page field

/**
 * @class	Nsplugin_Form_Generator
 * @brief	Form Generator
 */
class Nsplugin_Form_Generator
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
	private $m_iEntryID;
	
	/**
	 * @brief
	 */
	private $m_sAddFields;
	
	/**
	 * @brief
	 */
	private $m_sActionField = "";
	
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
	function __construct($page, $action, $request, $entry_id = null, $additional_fields = false)
	{
		$this->m_aFields = array();
		$this->m_sPage = $page;
		$this->m_sAction = $action;
		$this->m_sRequest = $request;
		$this->m_iEntryID = $entry_id;
		$this->m_sAddFields = $additional_fields;
	}
	
	/**
	 * @func	addField
	 * @brief	Add a field to the form
	 * @param	$id Field's ID
	 * @param	$type Field's type
	 * @param	$title
	 * @param	$value
	 * @param	$options
	 * @param	$formhidden
	 * @param	$null
	 */
	public function addField($id, $type, $title, $value = "", $options = array(), $formhidden = false, $null = false)
	{
		array_push($this->m_aFields, array("id" => $id, "type" => $type, "title" => $title, "value" => $value, "options" => $options, "formhidden" => $formhidden, "null" => $null));
	}
	
	/**
	 * @func	setActionField
	 * @brief	
	 * @param	$actionfield
	 */
	public function setActionField($actionfield)
	{
		$this->m_sActionField = $actionfield;
	}
	
	/*****************************************
	 ********* DISPLAY FIELD FUNCTIONS *******
	 *****************************************/
	
	/**
	 * @func	displayDateField
	 * @brief	Display a date field
	 * @param	$field Field information
	 */
	private function displayDateField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
				<td>
					<input type="text" id="<?php echo $field["id"]; ?>" name="<?php echo $field["id"]; ?>" value="<?php echo $field["value"]; ?>"/>
					<script type="text/javascript">
						jQuery(document).ready(function() 
						{
							jQuery('#<?php echo $field["id"]; ?>').datepicker({
								dateFormat : 'yy-mm-dd'
							});
						});
					</script>
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func	displayImageField
	 * @brief	Display an image field
	 * @param	$field Field's informations
	 */
	private function displayImageField($field)
	{
		global $wpdb;
		$src = '';
		
		// Get image's URL
		if(isset($field['value']) && $field['value'] != '')
		{
			// Get GUID
			$id = $field['value'];
			$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = $id;");
			if(count($data) > 0)
			{
				$guid = $data[0]->guid;
				$src = "src=\"" . $guid . "\"";
			}
			else
			{
				$src = "src=\"\"";
			}
		}
		
		?>
			<tr>
					<th scope="row">
						<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
					</th>
					<td>
						<div class="image-preview-wrapper">
							<img <?php echo $src; ?> class="image-preview" id="image-preview-<?php echo $field["id"]; ?>" data-target="<?php echo $field["id"]; ?>" width="100" height="100" style="max-height: 100px; width: 100px;">
						</div>
						<input class="upload_image_button button" type="button" value="<?php _e( 'Upload image' ); ?>" data-target="<?php echo $field["id"]; ?>" />
						<input type="hidden" name="<?php echo $field["id"]; ?>" id="<?php echo $field["id"]; ?>" class="image_attachment_id" value="<?php echo $field["value"]; ?>">
					</td>
				</tr>
		<?php
	}
	
	/**
	 * @func	displayTextField
	 * @brief	Display a text field
	 * @param	$field Field's informations
	 */
	private function displayTextField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
				<td>
					<input name="<?php echo $field["id"]; ?>" type="text" id="<?php echo $field["id"]; ?>" value="<?php echo $field["value"]; ?>" class="regular-text" />
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func	displayTextareaField
	 * @brief	Display a textarea field
	 * @param	field Field's informations
	 */
	private function displayTextareaField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
				<td>
					<textarea name="<?php echo $field["id"]; ?>" id="<?php echo $field["id"]; ?>" class="large-text code" rows="10"><?php echo $field["value"]; ?></textarea>
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func	displaySelectField
	 * @brief	Display a SELECT field
	 * @param	$field Field informations
	 */
	private function displaySelectField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
		<?php
		echo "<td><select name=\"{$field["id"]}\" id=\"{$field["id"]}\">";
		
		foreach($field["options"] as $key => $options)
		{
			?>
				<option value="<?php echo $key; ?>" <?php if($field["value"] == $key) echo "selected"; ?>><?php echo $options; ?></option>
			<?php
		}
		
		echo "</select></td></tr>";
	}
	
	/**
	 * @func	displayCategoryField
	 * @brief	Display a select category field
	 * @param	$field Field's information
	 */
	private function displayCategoryField($field)
	{
		// Categories
		$categories = $this->getAllCategory();
		
		?>
		<tr>
			<th scope="row">
				<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
			</th>
			<td>
				<select name="<?php echo $field["id"]; ?>">
					<?php
					// If can be null
					if($field['null'])
					{
						echo '<option value=""></option>';
					}
					
					// Entry for each category
					foreach($categories as $category)
					{
						if($field["value"] == $category->term_id)
							$selected = "selected";
						else
							$selected = "";
						echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<?php
	}
	
	/**
	 * @func	displayGalleryField
	 * @brief	Display a select gallery field
	 * @param	$field Field's informations
	 */
	private function displayGalleryField($field)
	{
		// Get all gallery
		$galleries = $this->getAllGallery();
		
		?>
		<tr>
			<th scope="row">
				<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
			</th>
			<td>
				<select name="<?php echo $field["id"]; ?>">
					<?php
					// If can be null
					if($field['null'])
					{
						echo '<option value=""></option>';
					}
					
					// Entry for each gallery
					foreach($galleries as $gallery)
					{
						if($field["value"] == $gallery->gallery_id)
							$selected = "selected";
						else
							$selected = "";
						echo '<option value="' . $gallery->gallery_id . '" ' . $selected . '>' . $gallery->gallery_name . '</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<?php
	}
	
	/**
	 * @func	displayBooleanField
	 * @brief	Display a checkbox field
	 * @param	$field Field's informations
	 */
	private function displayBooleanField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
				<td>
					<input name="<?php echo $field["id"]; ?>" type="checkbox" id="<?php echo $field["id"]; ?>" value="<?php if(isset($field["value"])) echo $field["value"]; else echo '0'; ?>" <?php if(isset($field["value"])) { if($field["value"] == 1) echo "checked"; } ?>>
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func	displayURLField
	 * @brief	Display a text URL field
	 * @param	$field Field's informations
	 */
	private function displayURLField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
				<td>
					<input name="<?php echo $field["id"]; ?>" type="text" id="<?php echo $field["id"]; ?>" value="<?php echo $field["value"]; ?>" class="regular-text" />
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func	displayColorField
	 * @brief	Display a color dialog field
	 * @param	$field Field's informations
	 */
	private function displayColorField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
				<td>
					<input name="<?php echo $field["id"]; ?>" type="text" id="<?php echo $field["id"]; ?>" value="<?php echo $field["value"]; ?>" data-alpha="true" data-default-color="rgba(0,0,0,0.85)" class="regular-text wp-color-picker color-picker" />
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func	displayFontSizeField
	 * @brief	Display a font size dialog field
	 * @param	$field Field's informations
	 */
	private function displayFontSizeField($field)
	{
		?>
			<tr>
				<th scope="row">
					<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
				</th>
				<td>
					<input name="<?php echo $field["id"]; ?>" type="number" id="<?php echo $field["id"]; ?>" value="<?php echo $field["value"]; ?>" class="regular-text" />
				</td>
			</tr>
		<?php
	}
	
	/**
	 * @func 	displayPageField
	 * @brief	Display a select field with each page
	 * @params	$field Field's informations
	 */
	private function displayPageField($field)
	{
		// Get all pages
		$pages = $this->getAllPages();
		
		?>
		<tr>
			<th scope="row">
				<label for="<?php echo $field["id"]; ?>"><?php echo $field["title"]; ?></label>
			</th>
			<td>
				<select name="<?php echo $field["id"]; ?>">
					<?php
					// If can be null
					if($field['null'])
					{
						echo '<option value=""></option>';
					}
					
					// Entry for each page
					foreach($pages as $page)
					{
						if($field["value"] == $page->ID)
							$selected = "selected";
						else
							$selected = "";
						echo '<option value="' . $page->ID . '" ' . $selected . '>' . $page->post_title . '</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<?php
	}
	
	/**
	 * @func	Display
	 * @brief	Display the form
	 * @param	$nonce Challenge to add in the form
	 */
	public function Display($nonce)
	{
		// Media scripts
		wp_enqueue_media();
		
		// Action page
		$actionpage = ($this->m_sActionField != "") ? $this->m_sActionField : "/wp-admin/admin.php?action={$this->m_sAction}&page={$this->m_sPage}&_wpnonce=$nonce";
		
		?>
			<form id="add-<?php echo $this->m_sPage; ?>-form" method="post" action="<?php echo $actionpage ?>">
				<input type="hidden" name="<?php echo $this->m_sPage; ?>" value="<?php echo $this->m_iEntryID; ?>" />
				<?php if($this->m_sAddFields) { settings_fields($this->m_sAddFields); } ?>
				<table class="form-table">
		<?php
		
		// For each field
		foreach($this->m_aFields as $field)
		{
			if(!isset($field['formhidden']) || $field['formhidden'] == false)
			{
				switch($field["type"])
				{
					case NS_FORM_TEXT:
						$this->displayTextField($field);
						break;
					case NS_FORM_TEXTAREA:
						$this->displayTextareaField($field);
						break;
					case NS_FORM_DATE:
						$this->displayDateField($field);
						break;
					case NS_FORM_IMAGE:
						$this->displayImageField($field);
						break;
					case NS_FORM_SELECT:
						$this->displaySelectField($field);
						break;
					case NS_FORM_CATEGORY:
						$this->displayCategoryField($field);
						break;
					case NS_FORM_BOOLEAN:
						$this->displayBooleanField($field);
						break;
					case NS_FORM_URL:
						$this->displayURLField($field);
						break;
					case NS_FORM_COLOR:
						$this->displayColorField($field);
						break;
					case NS_FORM_FONTSIZE:
					case NS_FORM_NUMBER:
						$this->displayFontSizeField($field);
						break;
					case NS_FORM_GALLERY:
						$this->displayGalleryField($field);
						break;
					case NS_FORM_PAGE:
						$this->displayPageField($field);
						break;
				}
			}
		}
		
		?>
				</table>
				<?php submit_button(); ?>
			</form>
		<?php
	}
	
	/*****************************************
	 ***** END DISPLAY FIELD FUNCTIONS *******
	 *****************************************/
	
	/**
	 * @func	getAllCategory
	 * @brief	Get all categories in the DB
	 */
	public function getAllCategory()
	{
		global $wpdb;
		
		// Get projects
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms;");
		
		return $data;
	}
	
	/**
	 * @func	getAllGallery
	 * @brief	Get all galleries in the DB
	 */
	public function getAllGallery()
	{
		global $wpdb;
		
		// Get galleries
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ns_gallery;");
		
		return $data;
	}
	
	/**
	 * @func	getAllPages
	 * @brief	Get all pages in the DB
	 * @return	Array of DB rows
	 */
	private function getAllPages()
	{
		global $wpdb;
		
		// Get galleries
		$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type LIKE 'post' OR post_type LIKE 'page';");
		
		return $data;
	}
	
}

?>
