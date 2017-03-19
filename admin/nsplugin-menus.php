<?php
	
	// Fields type
	require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-nsplugin-form-generator.php';
	
	// DB Type
	define('VARCHAR', 	0);
	define('NUM', 		1);
	define('DATE', 		2);
	define('ENUM', 		3);
	
	/**************************************************
	 * HEADERS
	 **************************************************/
	$headersSubmenus = 		array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$headersFields =		array(			"header_position"			=> array("type" => NS_FORM_TEXT,		"title" => "Pos.",				"value" => "header_position",			"dbtype" => NUM,	"null" => false,	"sortable" => true,	 "main" => true,  "length" => 50, "formhidden" => true),
											"header_post_id"			=> array("type" => NS_FORM_IMAGE,		"title" => "Image",				"value" => "header_post_id", 			"dbtype" => NUM,	"null" => false,	"sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, 	"imageheight" => 70),
											"header_subtitle"			=> array("type" => NS_FORM_TEXT,		"title" => "Subtitle",			"value" => "header_subtitle", 			"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_desc"				=> array("type" => NS_FORM_TEXTAREA,	"title" => "Desc.",				"value" => "header_desc", 				"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_page_post_id"		=> array("type" => NS_FORM_PAGE, 		"title" => "Link",				"value" => "header_page_post_id", 		"dbtype" => NUM,	"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_subtitlesize"		=> array("type" => NS_FORM_FONTSIZE, 	"title" => "Subtitle size",		"value" => "header_subtitlesize",	 	"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_h1color"			=> array("type" => NS_FORM_COLOR, 		"title" => "Title color", 		"value" => "header_h1color", 			"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_h1shadow"			=> array("type" => NS_FORM_TEXT, 		"title" => "Title shadow", 		"value" => "header_h1shadow", 			"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_h2color"			=> array("type" => NS_FORM_COLOR, 		"title" => "Subtitle color",	"value" => "header_h2color", 			"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_h2shadow"			=> array("type" => NS_FORM_TEXT, 		"title" => "Subtitle shadow",	"value" => "header_h2shadow", 			"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_abstractcolor"		=> array("type" => NS_FORM_COLOR, 		"title" => "Abstract color", 	"value" => "header_abstractcolor",		"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_abstractshadow"		=> array("type" => NS_FORM_TEXT, 		"title" => "Abstract shadow", 	"value" => "header_abstractshadow",		"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_menucolor"			=> array("type" => NS_FORM_COLOR, 		"title" => "Menu color", 		"value" => "header_menucolor", 			"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_menushadow"			=> array("type" => NS_FORM_TEXT, 		"title" => "Menu shadow", 		"value" => "header_menushadow", 		"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_menubordercolor"	=> array("type" => NS_FORM_COLOR, 		"title" => "Menu border color", "value" => "header_menubordercolor",	"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_buttoncolor"		=> array("type" => NS_FORM_COLOR, 		"title" => "Button color", 		"value" => "header_buttoncolor", 		"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_buttontextcolor"	=> array("type" => NS_FORM_COLOR, 		"title" => "Button text color", "value" => "header_buttontextcolor",	"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"header_imagesprefix"		=> array("type" => NS_FORM_TEXT, 		"title" => "Images suffix", 	"value" => "header_imagesprefix", 		"dbtype" => VARCHAR,"null" => false,	"sortable" => false, "main" => false, "length" => 50));
	
	// Row actions
	$headersRowActions =	array(			"edit"				=> array("url" => false, "title" => "Edit", "page" => "add_headers"), "down" => array("url" => true, "title" => "Down", "page" => "headers"), "up" => array("url" => true, "title" => "Up", "page" => "headers"), "delete" => array("url" => true, "title" => "Delete", "page" => "headers"));
	
	// Bulk actions
	$headersBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Menu
	$headersMenu = 			array(			"title" => 'Headers', 
											"id" => 'headers', 
											"submenus" => $headersSubmenus, 
											"fields" => $headersFields, 
											"table" => 'ns_headers',
											"positionfield" => 'header_position',
											"singular" => 'header',
											"plural" => 'headers',
											"ajax" => false,
											"rowactions" => $headersRowActions,
											"bulkactions" => $headersBulkActions,
											"order" => 'header_position',
											"asc" => 'asc',
											"dashicon" => 'dashicons-art',
											"researchfield" => 'header_subtitle',
											"idfield" => 'header_id');
	
	/**************************************************
	 * HOME
	 **************************************************/
	$homeSubmenus = 		array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$homeFields =			array(			"home_position"		=> array("type" => NS_FORM_TEXT,	"title" => "Pos.",		"value" => "home_position",		"dbtype" => NUM,  "null" => false,	"sortable" => true, "main" => true,  "length" => 50, "formhidden" => true),
											"home_type"			=> array("type" => NS_FORM_SELECT,	"title" => "Type",		"value" => "home_type",			"dbtype" => ENUM, "null" => false,	"sortable" => true, "main" => false, "length" => 50, "options" => array('HOME_TYPE_CATEGORY' => "Category", 'HOME_TYPE_FOLLOWME' => "Follow me", 'HOME_TYPE_PUBLICATIONS' => "Publications", 'HOME_TYPE_PROJECTS' => "Projects", 'HOME_TYPE_POST_ID' => "Medias", 'HOME_TYPE_ABOUT' => "About", 'HOME_TYPE_SQUARE' => "Square")),
											"home_color"		=> array("type" => NS_FORM_SELECT,	"title" => "Color",		"value" => "home_color",		"dbtype" => ENUM, "null" => false,	"sortable" => true, "main" => false, "length" => 50, "options" => array('HOME_COLOR_WHITE' => "White", 'HOME_COLOR_LIGHTGREY' => "Light grey", 'HOME_COLOR_DARKGREY' => "Dark Grey", 'HOME_COLOR_DARKERGREY' => "Darker Grey")),
											"home_term_id"		=> array("type" => NS_FORM_CATEGORY,"title" => "Category",	"value" => "home_term_id",		"dbtype" => NUM,  "null" => true,	"sortable" => true, "main" => false, "length" => 50),
											"home_gallery_id"	=> array("type" => NS_FORM_GALLERY,	"title" => "Gallery",	"value" => "home_gallery_id",	"dbtype" => NUM,  "null" => true,	"sortable" => true, "main" => false, "length" => 50));
	
	// Row actions
	$homeRowActions =		array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_home"), "down" => array("url" => true, "title" => "Down", "page" => "home"), "up" => array("url" => true, "title" => "Up", "page" => "home"), "delete" => array("url" => true, "title" => "Delete", "page" => "home"));
	
	// Bulk actions
	$homeBulkActions =		array(			"bulk-delete" => "Delete");
	$homeAggrFields =		array(			'home_type');
	$homeMenu = 			array(			"title" => 'Home', 
											"id" => 'home', 
											"submenus" => $homeSubmenus, 
											"fields" => $homeFields, 
											"table" => 'ns_home',
											"positionfield" => 'home_position',
											"singular" => 'section',
											"plural" => 'sections',
											"ajax" => false,
											"rowactions" => $homeRowActions,
											"bulkactions" => $homeBulkActions,
											"order" => 'home_position',
											"asc" => 'asc',
											"dashicon" => 'dashicons-admin-home',
											"aggrfields" => $homeAggrFields,
											"idfield" => 'home_id');
	
	/**************************************************
	 * RESEARCHES
	 **************************************************/
	$researchesSubmenus = 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$researchesFields =		array(			"research_name" 			=> array("type" => NS_FORM_TEXT,	"title" => "Name",			"value" => "research_name",			"dbtype" => VARCHAR, "null" => false,	"sortable" => true,  "main" => true,  "length" => 50),
											"research_desc"				=> array("type" => NS_FORM_TEXTAREA,"title" => "Description",	"value" => "research_desc",			"dbtype" => VARCHAR, "null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"research_shortdesc"		=> array("type" => NS_FORM_TEXTAREA,"title" => "Short. desc",	"value" => "research_shortdesc",	"dbtype" => VARCHAR, "null" => false,	"sortable" => false, "main" => false, "length" => 50),
											"research_page_post_id"		=> array("type" => NS_FORM_PAGE,	"title" => "Page",			"value" => "research_page_post_id",	"dbtype" => NUM,	 "null" => false,	"sortable" => true,  "main" => false, "length" => 50),
											"research_gallery_id"		=> array("type" => NS_FORM_GALLERY,	"title" => "Image",			"value" => "research_gallery_id",	"dbtype" => NUM, 	 "null" => true,	"sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70),
											"research_keywords"			=> array("type" => NS_FORM_TEXTAREA,"title" => "Keywords",		"value" => "research_keywords",		"dbtype" => VARCHAR, "null" => false,	"sortable" => false, "main" => false, "length" => 50));
	
	// Row actions
	$researchesRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_researches"), "delete" => array("url" => true, "title" => "Delete", "page" => "researches"), "active" => array("url" => true, "title" => "(De)active", "page" => "researches"), "terms" => array("url" => true, "title" => "Categories", "page" => "researches"));
	
	// Bulk actions
	$researchesBulkActions = array(			"bulk-delete" => "Delete");
	
	// Menu
	$researchesMenu = 		array(			"title" => 'Researches', 
											"id" => 'researches', 
											"submenus" => $researchesSubmenus, 
											"fields" => $researchesFields, 
											"table" => 'ns_researches',
											"singular" => "research",
											"plural" => "researches",
											"ajax" => false,
											"rowactions" => $researchesRowActions,
											"bulkactions" => $researchesBulkActions,
											"order" => 'research_name',
											"asc" => 'asc',
											"dashicon" => 'dashicons-chart-area',
											"researchfield" => 'research_name',
											"mediatable" => 'nsresearchmedia',
											"pubtable" => 'ns_researchpub',
											"terms_table" => 'ns_researches_terms',
                                            "tags_table" => 'ns_researches_tags',
											"display_field" => 'research_name',
											"idfield" => 'research_id');
	
	/**************************************************
	 * PROJECTS
	 **************************************************/
	$projectsSubmenus = 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$projectsFields =		array(			"project_name" 					=> array("type" => NS_FORM_TEXT,	"title" => "Name",			"value" => "project_name",				"dbtype" => VARCHAR, "null" => false, "sortable" => true, "main" => true, "length" => 50),
											"project_desc" 					=> array("type" => NS_FORM_TEXTAREA,"title" => "Description",	"value" => "project_desc",				"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"project_shortdesc" 			=> array("type" => NS_FORM_TEXTAREA,"title" => "Short. desc",	"value" => "project_shortdesc",			"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"project_post_id" 				=> array("type" => NS_FORM_IMAGE,	"title" => "Image",			"value" => "project_post_id",			"dbtype" => NUM, 	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70, "default" => 0),
											"project_page_post_id"			=> array("type" => NS_FORM_PAGE,	"title" => "Page",			"value" => "project_page_post_id",		"dbtype" => NUM,	 "null" => false, "sortable" => true,  "main" => false, "length" => 50),
											"project_background_post_id"	=> array("type" => NS_FORM_IMAGE,	"title" => "Pres. 1",		"value" => "project_background_post_id","dbtype" => NUM, 	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70, "default" => 0),
											"project_foreground_post_id" 	=> array("type" => NS_FORM_IMAGE,	"title" => "Pres. 2",		"value" => "project_foreground_post_id","dbtype" => NUM,	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70, "default" => 0),
											"project_gallery_id"			=> array("type" => NS_FORM_GALLERY,	"title" => "Gallery",		"value" => "project_gallery_id",		"dbtype" => NUM, 	 "null" => true,  "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70),
											"project_bmin" 					=> array("type" => NS_FORM_NUMBER,	"title" => "Back. min",		"value" => "project_bmin",				"dbtype" => NUM,	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "default" => 0),
											"project_bmax" 					=> array("type" => NS_FORM_NUMBER,	"title" => "Back. max",		"value" => "project_bmax",				"dbtype" => NUM, 	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "default" => 0),
											"project_fmin" 					=> array("type" => NS_FORM_NUMBER,	"title" => "Fore. min",		"value" => "project_fmin",				"dbtype" => NUM, 	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "default" => 0),
											"project_fmax" 					=> array("type" => NS_FORM_NUMBER,	"title" => "Fore. max",		"value" => "project_fmax",				"dbtype" => NUM, 	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "default" => 0),
											"project_textcolor" 			=> array("type" => NS_FORM_COLOR,	"title" => "Text color",	"value" => "project_textcolor",			"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"project_buttontextcolor" 		=> array("type" => NS_FORM_COLOR,	"title" => "Button color",	"value" => "project_buttontextcolor",	"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"project_line" 					=> array("type" => NS_FORM_SELECT,	"title" => "Line",			"value" => "project_line",				"dbtype" => ENUM, 	 "null" => false, "sortable" => true, "main" => false, "length" => 50, "options" => array('PROJECT_LINE_LIGHT' => "Light", 'PROJECT_LINE_DARK' => "Dark")),
											"project_startdate" 			=> array("type" => NS_FORM_DATE,	"title" => "Start date",	"value" => "project_startdate",			"dbtype" => VARCHAR, "null" => false, "sortable" => true, "main" => false, "length" => 50),
											"project_enddate" 				=> array("type" => NS_FORM_DATE,	"title" => "End date",		"value" => "project_enddate",			"dbtype" => VARCHAR, "null" => false, "sortable" => true, "main" => false, "length" => 50),
											"project_active" 				=> array("type" => NS_FORM_BOOLEAN,	"title" => "Active ?",		"value" => "project_active",			"dbtype" => VARCHAR, "null" => false, "sortable" => true, "main" => false, "length" => 50),
											"project_todisplay" 			=> array("type" => NS_FORM_BOOLEAN,	"title" => "To display ?",	"value" => "project_todisplay",			"dbtype" => VARCHAR, "null" => false, "sortable" => true, "main" => false, "length" => 50),
											"project_externalurl" 			=> array("type" => NS_FORM_URL,		"title" => "Ext. URL",		"value" => "project_externalurl",		"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"project_keywords" 				=> array("type" => NS_FORM_TEXTAREA,"title" => "Keywords",		"value" => "project_keywords",			"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"project_morecolor" 			=> array("type" => NS_FORM_COLOR,	"title" => "More color",	"value" => "project_morecolor",			"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50));
	
	// Row actions
	$projectsRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_projects"), "delete" => array("url" => true, "title" => "Delete", "page" => "projects"), "activate" => array("url" => true, "title" => "(De)active", "page" => "projects"), "terms" => array("url" => true, "title" => "Categories", "page" => "projects"));
	
	// Bulk actions
	$projectsBulkActions = 	array(			"bulk-delete" => "Delete", "bulk-activate" => "(De)Activate");
	
	// Menu
	$projectsMenu = 		array(			"title" => 'Projects', 
											"id" => 'projects', 
											"submenus" => $projectsSubmenus, 
											"fields" => $projectsFields, 
											"table" => 'ns_projects',
											"singular" => "field",
											"plural" => "fields",
											"ajax" => false,
											"rowactions" => $projectsRowActions,
											"bulkactions" => $projectsBulkActions,
											"order" => 'project_enddate',
											"asc" => 'asc',
											"dashicon" => 'dashicons-feedback',
											"researchfield" => 'project_name',
											"terms_table" => 'ns_projects_terms',
											"display_field" => 'project_name',
											"idfield" => 'project_id');
	
	/**************************************************
	 * PUBLICATIONS
	 **************************************************/
	$publicationsSubmenus = 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$publicationsFields =		array(			"pub_title"			=> array("type" => NS_FORM_TEXT,	"title" => "Title",			"value" => "pub_title",			"dbtype" => VARCHAR, "null" => false,	"sortable" => true, "main" => true,  "length" => 50),
												"pub_authors"		=> array("type" => NS_FORM_TEXT,	"title" => "Authors",		"value" => "pub_authors",		"dbtype" => VARCHAR, "null" => false,	"sortable" => true, "main" => false, "length" => 50),
												"pub_abstract"		=> array("type" => NS_FORM_TEXTAREA,"title" => "Abstract",		"value" => "pub_abstract",		"dbtype" => VARCHAR, "null" => false,	"sortable" => false,"main" => false, "length" => 50),
												"pub_date"			=> array("type" => NS_FORM_DATE,	"title" => "Date",			"value" => "pub_date",			"dbtype" => DATE,	 "null" => false,	"sortable" => true, "main" => false, "length" => 50),
												"pub_url"			=> array("type" => NS_FORM_URL,		"title" => "Link",			"value" => "pub_url",			"dbtype" => VARCHAR, "null" => false,	"sortable" => false,"main" => false, "length" => 50),
												"pub_post_id"		=> array("type" => NS_FORM_IMAGE,	"title" => "Image",			"value" => "pub_post_id",		"dbtype" => NUM,	 "null" => true, 	"sortable" => false,"main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70),
												"pub_keywords"		=> array("type" => NS_FORM_TEXTAREA,"title" => "Keywords",		"value" => "pub_keywords",		"dbtype" => VARCHAR, "null" => false,	"sortable" => false,"main" => false, "length" => 50),
												"pub_type"			=> array("type" => NS_FORM_SELECT,	"title" => "Type",			"value" => "pub_type",			"dbtype" => ENUM,	 "null" => false,	"sortable" => true, "main" => false, "length" => 50, "options" => array('PUB_TYPE_CONFERENCE_PAPER' => "Conference paper", 'PUB_TYPE_JOURNAL_PAPER' => "Journal paper", 'PUB_TYPE_BOOK' => "Book", 'PUB_TYPE_MASTER_THESIS' => "Master thesis", 'PUB_TYPE_PHD_THESIS' => "PhD thesis", 'PUB_TYPE_POSTER' => "Poster")),
												"pub_publisher"		=> array("type" => NS_FORM_TEXT,	"title" => "Publisher",		"value" => "pub_publisher",		"dbtype" => VARCHAR, "null" => false,	"sortable" => true, "main" => false, "length" => 50),
												"pub_edition"		=> array("type" => NS_FORM_TEXT,	"title" => "Edition",		"value" => "pub_edition",		"dbtype" => VARCHAR, "null" => false,	"sortable" => true, "main" => false, "length" => 50),
												"pub_publisherlink"	=> array("type" => NS_FORM_URL,		"title" => "Publisher URL",	"value" => "pub_publisherlink",	"dbtype" => VARCHAR, "null" => false,	"sortable" => false,"main" => false, "length" => 50),
												"pub_publishercomp"	=> array("type" => NS_FORM_TEXTAREA,"title" => "Complement",	"value" => "pub_publishercomp",	"dbtype" => VARCHAR, "null" => false,	"sortable" => false,"main" => false, "length" => 50),
												"pub_filetype"		=> array("type" => NS_FORM_SELECT,	"title" => "File type",		"value" => "pub_filetype",		"dbtype" => ENUM,	 "null" => false,	"sortable" => true, "main" => false, "length" => 50, "options" => array('PUB_FILETYPE_PDF' => "PDF", 'PUB_FILETYPE_HTML' => "HTML")));
	
	// Row actions
	$publicationsRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_publications"), "delete" => array("url" => true, "title" => "Delete", "page" => "publications"), "terms" => array("url" => true, "title" => "Categories", "page" => "publications"));
	
	// Bulk actions
	$publicationsBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Aggr. fields
	$publicationsAggrFields =	array(			"pub_type", "pub_filetype");
	
	// Menu
	$publicationsMenu = 		array(			"title" => 'Publications', 
												"id" => 'publications', 
												"submenus" => $publicationsSubmenus, 
												"fields" => $publicationsFields, 
												"table" => 'ns_publications',
												"singular" => "field",
												"plural" => "fields",
												"ajax" => false,
												"rowactions" => $publicationsRowActions,
												"bulkactions" => $publicationsBulkActions,
												"order" => 'pub_date',
												"asc" => 'desc',
												"dashicon" => 'dashicons-media-text',
												"researchfield" => 'pub_title',
												"aggrfields" => $publicationsAggrFields,
												"terms_table" => 'ns_publications_terms',
												"display_field" => 'pub_title',
												"idfield" => 'pub_id');
	
	/**************************************************
	 * EDUCATION
	 **************************************************/
	$educationSubmenus = 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$educationFields =		array(			"edu_degree"	=> array("type" => NS_FORM_TEXT,	"title" => "Degree",		"value" => "edu_degree",	 "dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => true,  "length" => 50),
											"edu_college"	=> array("type" => NS_FORM_TEXT,	"title" => "College", 		"value" => "edu_college",	 "dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"edu_country"	=> array("type" => NS_FORM_TEXT,	"title" => "Country",		"value" => "edu_country",	 "dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"edu_url"		=> array("type" => NS_FORM_URL,		"title" => "URL",			"value" => "edu_url",		 "dbtype" => VARCHAR,	"null" => false, "sortable" => false,"main" => false, "length" => 50),
											"edu_post_id"	=> array("type" => NS_FORM_IMAGE,	"title" => "Image",			"value" => "edu_post_id",	 "dbtype" => NUM,		"null" => false, "sortable" => false,"main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70),
											"edu_major"		=> array("type" => NS_FORM_TEXT,	"title" => "Major",			"value" => "edu_major",		 "dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"edu_minor"		=> array("type" => NS_FORM_TEXT,	"title" => "Minor",			"value" => "edu_minor",		 "dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"edu_begin"		=> array("type" => NS_FORM_DATE,	"title" => "Begin",			"value" => "edu_begin",		 "dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"edu_end"		=> array("type" => NS_FORM_DATE,	"title" => "End",			"value" => "edu_end",		 "dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"edu_honors"	=> array("type" => NS_FORM_TEXTAREA,"title" => "Honors",		"value" => "edu_honors",	 "dbtype" => VARCHAR,	"null" => false, "sortable" => false,"main" => false, "length" => 50),
											"edu_desc"		=> array("type" => NS_FORM_TEXTAREA,"title" => "Description",	"value" => "edu_desc",		 "dbtype" => VARCHAR,	"null" => false, "sortable" => false,"main" => false, "length" => 50));
	
	// Row actions
	$educationRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_education"), "delete" => array("url" => true, "title" => "Delete", "page" => "education"));
	
	// Bulk actions
	$educationBulkActions = array(			"bulk-delete" => "Delete");
	
	// Aggr fields
	$educationAggrFields =	array(			"edu_college", "edu_country");
	
	// Menu
	$educationMenu = 		array(			"title" => 'Education', 
											"id" => 'education', 
											"submenus" => $educationSubmenus, 
											"fields" => $educationFields, 
											"table" => 'ns_education',
											"singular" => "field",
											"plural" => "fields",
											"ajax" => false,
											"rowactions" => $educationRowActions,
											"bulkactions" => $educationBulkActions,
											"order" => 'edu_end',
											"asc" => 'desc',
											"dashicon" => 'dashicons-welcome-learn-more',
											"researchfield" => 'edu_degree',
											"aggrfields" => $educationAggrFields,
											"idfield" => 'edu_id');
	
	/**************************************************
	 * WORKING EXPERIENCE
	 **************************************************/
	$workexpSubmenus = 		array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$workexpFields =		array(			"workexp_position"	=> array("type" => NS_FORM_TEXT,	"title" => "Position",	 "value" => "workexp_position",	"dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => true, "length" => 50),
											"workexp_company"	=> array("type" => NS_FORM_TEXT,	"title" => "Company",	 "value" => "workexp_company",	"dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"workexp_address"	=> array("type" => NS_FORM_TEXT,	"title" => "Address",	 "value" => "workexp_address",	"dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"workexp_country"	=> array("type" => NS_FORM_TEXT,	"title" => "Country",	 "value" => "workexp_country",	"dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"workexp_url"		=> array("type" => NS_FORM_URL,		"title" => "URL",		 "value" => "workexp_url",		"dbtype" => VARCHAR,	"null" => false, "sortable" => false, "main" => false, "length" => 50),
											"workexp_post_id"	=> array("type" => NS_FORM_IMAGE,	"title" => "Image",		 "value" => "workexp_post_id",	"dbtype" => NUM,		"null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70),
											"workexp_honors"	=> array("type" => NS_FORM_TEXTAREA,"title" => "Honors",	 "value" => "workexp_honors",	"dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"workexp_desc"		=> array("type" => NS_FORM_TEXTAREA,"title" => "Description","value" => "workexp_desc",		"dbtype" => VARCHAR,	"null" => false, "sortable" => false, "main" => false, "length" => 50),
											"workexp_begin"		=> array("type" => NS_FORM_DATE,	"title" => "Begin",		 "value" => "workexp_begin",	"dbtype" => DATE,		"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"workexp_end"		=> array("type" => NS_FORM_DATE,	"title" => "End",		 "value" => "workexp_end",		"dbtype" => DATE,		"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"workexp_duration"	=> array("type" => NS_FORM_NUMBER,	"title" => "Durée",		 "value" => "workexp_duration",	"dbtype" => NUM,		"null" => false, "sortable" => true, "main" => false, "length" => 50));
	
	// Row actions
	$workexpRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_workexp"), "delete" => array("url" => true, "title" => "Delete", "page" => "workexp"));
	
	// Bulk actions
	$workexpBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Aggr. fields
	$workexpAggrFields =	array(			"workexp_company", "workexp_address");
	
	// Menu
	$workexpMenu = 			array(			"title" => 'Working experience', 
											"id" => 'workexp', 
											"submenus" => $workexpSubmenus, 
											"classlist" => 'Nsplugin_List_AboutFields', 
											"fields" => $workexpFields, 
											"table" => 'ns_workexp',
											"singular" => "experience",
											"plural" => "experiences",
											"ajax" => false,
											"rowactions" => $workexpRowActions,
											"bulkactions" => $workexpBulkActions,
											"order" => 'workexp_end',
											"asc" => 'desc',
											"dashicon" => 'dashicons-building',
											"researchfield" => 'workexp_position',
											"aggrfields" => $workexpAggrFields,
											"idfield" => 'workexp_id');
	
	/**************************************************
	 * AWARDS
	 **************************************************/
	$awardsSubmenus = 		array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$awardsFields =			array(			"award_title"		=> array("type" => NS_FORM_TEXT,	"title" => "Title",			"value" => "award_title",		"dbtype" => VARCHAR, "null" => false, "sortable" => true,  "main" => true,  "length" => 50),
											"award_abbr"		=> array("type" => NS_FORM_TEXT,	"title" => "Abbr.",			"value" => "award_abbr",		"dbtype" => VARCHAR, "null" => false, "sortable" => true,  "main" => false, "length" => 50),
											"award_source"		=> array("type" => NS_FORM_TEXT,	"title" => "From",			"value" => "award_source",		"dbtype" => VARCHAR, "null" => false, "sortable" => true,  "main" => false, "length" => 50),
											"award_sourceurl"	=> array("type" => NS_FORM_URL,		"title" => "From (URL)",	"value" => "award_sourceurl",	"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"award_date"		=> array("type" => NS_FORM_DATE,	"title" => "Date",			"value" => "award_date",		"dbtype" => VARCHAR, "null" => false, "sortable" => true,  "main" => false, "length" => 50),
											"award_reason"		=> array("type" => NS_FORM_TEXTAREA,"title" => "For",			"value" => "award_reason",		"dbtype" => VARCHAR, "null" => false, "sortable" => true,  "main" => false, "length" => 50),
											"award_reasonurl"	=> array("type" => NS_FORM_URL,		"title" => "For (URL)",		"value" => "award_reasonurl",	"dbtype" => VARCHAR, "null" => false, "sortable" => false, "main" => false, "length" => 50),
											"award_post_id"		=> array("type" => NS_FORM_IMAGE,	"title" => "Image",			"value" => "award_post_id",		"dbtype" => NUM,	 "null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70));
	
	// Row actions
	$awardsRowActions =		array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_awards"), "delete" => array("url" => true, "title" => "Delete", "page" => "awards"));
	
	// Bulk actions
	$awardsBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Aggr. fields
	$awardsAggrFields =		array(			"award_source");
	
	// Menu
	$awardsMenu = 			array(			"title" => 'Awards', 
											"id" => 'awards', 
											"submenus" => $awardsSubmenus, 
											"classlist" => 'Nsplugin_List_AboutFields', 
											"fields" => $awardsFields, 
											"table" => 'ns_awards',
											"singular" => "field",
											"plural" => "fields",
											"ajax" => false,
											"rowactions" => $awardsRowActions,
											"bulkactions" => $awardsBulkActions,
											"order" => 'award_date',
											"asc" => 'desc',
											"dashicon" => 'dashicons-awards',
											"researchfield" => 'award_title',
											"aggrfields" => $awardsAggrFields,
											"idfield" => 'award_id');
	
	/**************************************************
	 * ABOUT ME
	 **************************************************/
	$aboutmeSubmenus = 		array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$aboutmeFields =		array(			"aboutfield_position"		=> array("type" => NS_FORM_NUMBER,	"title" => "Pos.",		"value" => "aboutfield_position",	"dbtype" => NUM,	"null" => false, "sortable" => true, "main" => true,  "length" => 50, "formhidden" => true),
											"aboutfield_name"			=> array("type" => NS_FORM_TEXT,	"title" => "Name",		"value" => "aboutfield_name",		"dbtype" => VARCHAR,"null" => false, "sortable" => true, "main" => false, "length" => 50),
											"aboutfield_type"			=> array("type" => NS_FORM_SELECT,	"title" => "Type",		"value" => "aboutfield_type",		"dbtype" => ENUM,	"null" => false, "sortable" => true, "main" => false, "length" => 50, "default" => 'ABOUTFIELD_TYPE_STRING', "options" => array('ABOUTFIELD_TYPE_STRING' => "string", 'ABOUTFIELD_TYPE_INT' => "int", 'ABOUTFIELD_TYPE_POSTID' => "image")),
											"aboutfield_stringvalue"	=> array("type" => NS_FORM_TEXTAREA,"title" => "String",	"value" => "aboutfield_stringvalue","dbtype" => VARCHAR,"null" => true,  "sortable" => true, "main" => false, "length" => 50),
											"aboutfield_intvalue"		=> array("type" => NS_FORM_NUMBER,	"title" => "Integer",	"value" => "aboutfield_intvalue",	"dbtype" => NUM,	"null" => true,  "sortable" => true, "main" => false, "length" => 50),
											"aboutfield_post_id"		=> array("type" => NS_FORM_IMAGE,	"title" => "Image",		"value" => "aboutfield_post_id",	"dbtype" => NUM,	"null" => true,  "sortable" => false,"main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70));
	
	// Row actions
	$aboutmeRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_aboutme"), "down" => array("url" => true, "title" => "Down", "page" => "aboutme"), "up" => array("url" => true, "title" => "Up", "page" => "aboutme"), "delete" => array("url" => true, "title" => "Delete", "page" => "aboutme"));
	
	// Bulk actions
	$aboutmeBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Menu
	$aboutmeMenu = 			array(			"title" => 'About me', 
											"id" => 'aboutme', 
											"submenus" => $aboutmeSubmenus, 
											"classlist" => 'Nsplugin_List_AboutFields', 
											"fields" => $aboutmeFields, 
											"table" => 'ns_aboutfields',
											"positionfield" => 'aboutfield_position',
											"singular" => "field",
											"plural" => "fields",
											"ajax" => false,
											"rowactions" => $aboutmeRowActions,
											"bulkactions" => $aboutmeBulkActions,
											"order" => 'aboutfield_position',
											"asc" => 'asc',
											"dashicon" => 'dashicons-id-alt',
											"researchfield" => 'aboutfield_name',
											"idfield" => 'aboutfield_id');
	
	/*****************************************************
	 * LANGUAGES
	 *****************************************************/
	
	// Menus
	$languagesSubmenus = 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$languagesFields =		array(			"lang_language"	=> array("type" => NS_FORM_TEXT,	"title" => "Language",		"value" => "lang_language",	"dbtype" => VARCHAR,	"null" => false, "sortable" => true, "main" => true,   "length" => 50),
											"lang_level"	=> array("type" => NS_FORM_SELECT,	"title" => "Level",			"value" => "lang_level",	"dbtype" => ENUM,		"null" => false, "sortable" => true, "main" => false,  "length" => 50, "options" => array('LANG_LEVEL_NONE' => "None", 'LANG_LEVEL_BEGINNER' => "Beginner", 'LANG_LEVEL_INTERMEDIATE' => "Intermediate", 'LANG_LEVEL_ADVANCED' => "Advanced", 'LANG_LEVEL_NATURAL' => "Native")),
											"lang_desc" 	=> array("type" => NS_FORM_TEXTAREA,"title" => "Description",	"value" => "lang_desc",		"dbtype" => VARCHAR,	"null" => false, "sortable" => false, "main" => false, "length" => 50),
											"lang_post_id"	=> array("type" => NS_FORM_IMAGE,	"title" => "Image",			"value" => "lang_post_id",	"dbtype" => NUM,		"null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70));
	
	// Row actions
	$languagesRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_languages"), "delete" => array("url" => true, "title" => "Delete", "page" => "languages"));
	
	// Bulk actions
	$languagesBulkActions = array(			"bulk-delete" => "Delete");
	
	// Aggr. fields
	$languagesAggrFields =	array(			"lang_level");
	
	// Menu
	$languagesMenu = 		array(			"title" => 'Languages', 
											"id" => 'languages', 
											"submenus" => $languagesSubmenus, 
											"fields" => $languagesFields, 
											"table" => 'ns_languages',
											"singular" => "language",
											"plural" => "languages",
											"ajax" => false,
											"rowactions" => $languagesRowActions,
											"bulkactions" => $languagesBulkActions,
											"order" => 'lang_level',
											"asc" => 'desc',
											"dashicon" => 'dashicons-megaphone',
											"researchfield" => 'lang_language',
											"aggrfields" => $languagesAggrFields,
											"idfield" => 'lang_id');
	
	/*****************************************************
	 * HOBBIES
	 *****************************************************/
	
	// Menus
	$hobbiesSubmenus =	 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$hobbiesFields =		array(			"hobby_name"	=> array("type" => NS_FORM_TEXT,	"title" => "Name",	"value" => "hobby_name",	"dbtype" => VARCHAR,	"null" => false, "sortable" => true,	"main" => true,	"length" => 50),
											"hobby_post_id"	=> array("type" => NS_FORM_IMAGE,	"title" => "Image",	"value" => "hobby_post_id",	"dbtype" => NUM,		"null" => false, "sortable" => false,	"main" => false,"length" => 50, "imagewidth" => 70, "imageheight" => 70));
	
	// Row actions
	$hobbiesRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_hobbies"), "delete" => array("url" => true, "title" => "Delete", "page" => "hobbies"));
	
	// Bulk actions
	$hobbiesBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Menu
	$hobbiesMenu = 			array(			"title" => 'Hobbies', 
											"id" => 'hobbies', 
											"submenus" => $hobbiesSubmenus, 
											"fields" => $hobbiesFields, 
											"table" => 'ns_hobbies',
											"singular" => "hobby",
											"plural" => "hobbies",
											"ajax" => false,
											"rowactions" => $hobbiesRowActions,
											"bulkactions" => $hobbiesBulkActions,
											"order" => 'hobby_name',
											"asc" => 'asc',
											"dashicon" => 'dashicons-palmtree',
											"researchfield" => 'hobby_name',
											"idfield" => 'hobby_id');
	
	/*****************************************************
	 * Personal traits
	 *****************************************************/
	
	// Menus
	$traitsSubmenus =	 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$traitsFields =			array(			"trait_position"	=> array("type" => NS_FORM_NUMBER,		"title" => "Pos.",			"value" => "trait_position",	"dbtype" => NUM,	"null" => false, "sortable" => true,  "main" => true,  "length" => 50, "formhidden" => true),
											"trait_name"		=> array("type" => NS_FORM_TEXT,		"title" => "Name",			"value" => "trait_name",		"dbtype" => VARCHAR,"null" => false, "sortable" => true,  "main" => false, "length" => 50),
											"trait_desc"		=> array("type" => NS_FORM_TEXTAREA,	"title" => "Description",	"value" => "trait_desc",		"dbtype" => VARCHAR,"null" => false, "sortable" => false, "main" => false, "length" => 50),
											"trait_post_id"		=> array("type" => NS_FORM_IMAGE,		"title" => "Image",			"value" => "trait_post_id",		"dbtype" => NUM,	"null" => true,  "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70));
	
	// Row actions
	$traitsRowActions =		array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_traits"), "down" => array("url" => true, "title" => "Down", "page" => "traits"), "up" => array("url" => true, "title" => "Up", "page" => "traits"), "delete" => array("url" => true, "title" => "Delete", "page" => "traits"));
	
	// Bulk actions
	$traitsBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Menu
	$traitsMenu = 			array(			"title" => 'Personal traits', 
											"id" => 'traits', 
											"submenus" => $traitsSubmenus, 
											"fields" => $traitsFields, 
											"table" => 'ns_traits',
											"positionfield" => 'trait_position',
											"singular" => "trait",
											"plural" => "traits",
											"ajax" => false,
											"rowactions" => $traitsRowActions,
											"bulkactions" => $traitsBulkActions,
											"order" => 'trait_position',
											"asc" => 'asc',
											"dashicon" => 'dashicons-smiley',
											"researchfield" => 'trait_name',
											"idfield" => 'trait_id');
	
	/*****************************************************
	 * Achievements
	 *****************************************************/
	
	// Menus
	$achievementsSubmenus =	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$achievementsFields =	array(			"achv_position"	=> array("type" => NS_FORM_NUMBER,		"title" => "Pos.",			"value" => "achv_position",		"dbtype" => NUM,		"null" => false, "sortable" => true,	"main" => true,  "length" => 50, "formhidden" => true),
											"achv_abbr"		=> array("type" => NS_FORM_TEXT,		"title" => "Abbr.",			"value" => "achv_abbr",			"dbtype" => VARCHAR,	"null" => false, "sortable" => true, 	"main" => false, "length" => 50),
											"achv_desc"		=> array("type" => NS_FORM_TEXTAREA,	"title" => "Description",	"value" => "achv_desc",			"dbtype" => VARCHAR,	"null" => false, "sortable" => false,	"main" => false, "length" => 50),
											"achv_post_id"	=> array("type" => NS_FORM_IMAGE,		"title" => "Image",			"value" => "achv_post_id",		"dbtype" => NUM,		"null" => false, "sortable" => false,	"main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70));
	
	// Row actions
	$achievementsRowActions = array(		"edit" => array("url" => false, "title" => "Edit", "page" => "add_achievements"), "down" => array("url" => true, "title" => "Down", "page" => "achievements"), "up" => array("url" => true, "title" => "Up", "page" => "achievements"), "delete" => array("url" => true, "title" => "Delete", "page" => "achievements"));
	
	// Bulk actions
	$achievementsBulkActions = array(		"bulk-delete" => "Delete");
	
	// Menu
	$achievementsMenu = 	array(			"title" => 'Achievements', 
											"id" => 'achievements', 
											"submenus" => $achievementsSubmenus, 
											"fields" => $achievementsFields, 
											"table" => 'ns_achievements',
											"positionfield" => 'achv_position',
											"singular" => "achievement",
											"plural" => "achievements",
											"ajax" => false,
											"rowactions" => $achievementsRowActions,
											"bulkactions" => $achievementsBulkActions,
											"order" => 'achv_position',
											"asc" => 'asc',
											"dashicon" => 'dashicons-thumbs-up',
											"researchfield" => 'achv_name',
											"idfield" => 'achv_id');
	
	/*****************************************************
	 * GALLERY
	 *****************************************************/
	 
	// Menus
	$gallerySubmenus =	 	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$galleryFields =		array(			"gallery_name"		=> array("type" => NS_FORM_TEXT,	"title" => "Name",			"value" => "gallery_name",		"dbtype" => VARCHAR,	"null" => false, "sortable" => true,  "main" => true,  "length" => 50),
											"gallery_desc"		=> array("type" => NS_FORM_TEXTAREA,"title" => "Description",	"value" => "gallery_desc",		"dbtype" => VARCHAR,	"null" => false, "sortable" => false, "main" => false, "length" => 50),
											"gallery_post_id"	=> array("type" => NS_FORM_IMAGE,	"title" => "Image",			"value" => "gallery_post_id",	"dbtype" => NUM,		"null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70),
											"gallery_displayed"	=> array("type" => NS_FORM_BOOLEAN,	"title" => "To display",	"value" => "gallery_displayed",	"dbtype" => VARCHAR,	"null" => false, "sortable" => false, "main" => false, "length" => 50, "imagewidth" => 70, "imageheight" => 70));
	
	// Row actions
	$galleryRowActions =	array(			"edit" => array("url" => false, "title" => "Edit", "page" => "add_gallery"), "delete" => array("url" => true, "title" => "Delete", "page" => "gallery"), "images" => array("url" => true, "title" => "Images", "page" => "gallery"));
	
	// Bulk actions
	$galleryBulkActions = 	array(			"bulk-delete" => "Delete");
	
	// Menu
	$galleryMenu = 			array(			"title" => 'Gallery', 
											"id" => 'gallery', 
											"submenus" => $gallerySubmenus, 
											"fields" => $galleryFields, 
											"table" => 'ns_gallery',
											"singular" => "gallery",
											"plural" => "galleries",
											"ajax" => false,
											"rowactions" => $galleryRowActions,
											"bulkactions" => $galleryBulkActions,
											"order" => 'gallery_name',
											"asc" => 'asc',
											"dashicon" => 'dashicons-format-image',
											"researchfield" => 'gallery_name',
											"gallerytable" => 'ns_gallery_posts',
											"idfield" => 'gallery_id');
	
	/*****************************************************
	 * Header menu
	 *****************************************************/
	
	// Menus
	$headermenuSubmenus =	array(array(	"id"=>"add","title"=>"Ajouter"));
	
	// Fields
	$headermenuFields =		array(			"headermenu_position"	=> array("type" => NS_FORM_NUMBER,		"title" => "Pos.",			"value" => "headermenu_position",		"dbtype" => NUM,		"null" => false, "sortable" => true,	"main" => true,  "length" => 50, "formhidden" => true),
											"headermenu_title"		=> array("type" => NS_FORM_TEXT,		"title" => "Title",			"value" => "headermenu_title",			"dbtype" => VARCHAR,	"null" => false, "sortable" => true, 	"main" => false, "length" => 50),
											"headermenu_post_id"	=> array("type" => NS_FORM_PAGE,		"title" => "Page",			"value" => "headermenu_post_id",		"dbtype" => NUM,		"null" => true,  "sortable" => false,	"main" => false, "length" => 50),
											"headermenu_url"		=> array("type" => NS_FORM_TEXT,		"title" => "Link",			"value" => "headermenu_url",			"dbtype" => VARCHAR,	"null" => false, "sortable" => true, 	"main" => false, "length" => 50));
	
	// Row actions
	$headermenuRowActions 	= array(		"edit" => array("url" => false, "title" => "Edit", "page" => "add_headermenu"), "down" => array("url" => true, "title" => "Down", "page" => "headermenu"), "up" => array("url" => true, "title" => "Up", "page" => "headermenu"), "delete" => array("url" => true, "title" => "Delete", "page" => "headermenu"));
	
	// Bulk actions
	$headermenuBulkActions	 = array(		"bulk-delete" => "Delete");
	
	// Menu
	$headermenuMenu = 		array(			"title" => 'Header menu', 
											"id" => 'headermenu', 
											"submenus" => $headermenuSubmenus, 
											"fields" => $headermenuFields, 
											"table" => 'ns_headermenu',
											"positionfield" => 'headermenu_position',
											"singular" => "Menu",
											"plural" => "Menus",
											"ajax" => false,
											"rowactions" => $headermenuRowActions,
											"bulkactions" => $headermenuBulkActions,
											"order" => 'headermenu_position',
											"asc" => 'asc',
											"dashicon" => 'dashicons-menu',
											"researchfield" => 'headermenu_title',
											"idfield" => 'headermenu_id');

	// Menus
	$adminMenus = array("aboutme" => $aboutmeMenu, "achievements" => $achievementsMenu, "awards" => $awardsMenu, "education" => $educationMenu, "gallery" => $galleryMenu, "headers" => $headersMenu, "headermenu" => $headermenuMenu, "hobbies" => $hobbiesMenu, "home" => $homeMenu, "languages" => $languagesMenu, "traits" => $traitsMenu, "projects" => $projectsMenu, "publications" => $publicationsMenu, "researches" => $researchesMenu, "workexp" => $workexpMenu);

?>
