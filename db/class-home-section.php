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

// INCLUDES
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-publication.php';

// DEFINES
define('SECTION_TYPE_CATEGORY',		0);
define('SECTION_TYPE_FOLLOWME',		1);
define('SECTION_TYPE_PUBLICATIONS',	2);
define('SECTION_TYPE_PROJECTS',		3);
define('SECTION_TYPE_MEDIAS',		4);
define('SECTION_TYPE_ABOUTME',		5);
define('SECTION_TYPE_EDUCATION',	6);
define('SECTION_TYPE_WORKEXP',		7);
define('SECTION_TYPE_AWARDS',		8);
define('SECTION_TYPE_LINKS',		9);
define('SECTION_TYPE_CONTACT',		10);
define('SECTION_TYPE_PUBKEY',		11);
define('SECTION_TYPE_SCATEGORY',	12);
define('SECTION_TYPE_PCATEGORY',	13);
define('SECTION_TYPE_RESEARCH',		14);
define('SECTION_TYPE_PROJECT',		15);
define('SECTION_TYPE_SGALLERY',		16);

// COLORS
define('SECTION_COLOR_WHITE',		0);
define('SECTION_COLOR_LIGHTGREY',	1);
define('SECTION_COLOR_DARKGREY',	2);

class Nsplugin_Home_Section
{
	
	/**
	 * ID
	 */
	private $m_iID;
	
	/**
	 * Position on the page
	 */
	private $m_sPosition;
	
	/**
	 * Type of section
	 */
	private $m_iType;
	
	/**
	 * Category to display
	 */
	private $m_iTermID;
	
	/**
	 * Category name
	 */
	private $m_sTitle;
	
	/**
	 * Slug
	 */
	private $m_sLink;
	
	/**
	 * Term group
	 */
	private $m_sTermGroup;
	
	/**
	 * Color
	 */
	private $m_iColor;
	
	/**
	 * Galley
	 */
	private $m_iGID;
	
	/**
	 * Params
	 */
	private $m_aParams;
	
	/**
	 * Constructor
	 */
	public function __construct($id, $position, $type, $cat_id, $title, $slug, $term_group, $color, $gid, $params = array())
	{
		$this->m_iID = $id;
		$this->m_sPosition = $position;
		$this->m_iType = $type;
		$this->m_iTermID = $cat_id;
		$this->m_sLink = $slug;
		$this->m_sTermGroup = $term_group;
		$this->m_iColor = $color;
		$this->m_iGID = $gid;
		$this->m_aParams = $params;
		
		// Title
		switch($this->m_iType)
		{
			case SECTION_TYPE_PUBLICATIONS:
				$this->m_sTitle = "Publications";
				break;
			case SECTION_TYPE_FOLLOWME:
				$this->m_sTitle = "Follow me";
				break;
			case SECTION_TYPE_CATEGORY:
				$this->m_sTitle = $title;
				break;
			case SECTION_TYPE_PROJECTS:
				$this->m_sTitle = "Projects";
				break;
			case SECTION_TYPE_MEDIAS:
				$this->m_sTitle = "Medias";
				break;
			case SECTION_TYPE_ABOUTME:
				$this->m_sTitle = "About me";
				break;
			case SECTION_TYPE_EDUCATION:
				$this->m_sTitle = "Education";
				break;
			case SECTION_TYPE_WORKEXP:
				$this->m_sTitle = "Working experience";
				break;
			case SECTION_TYPE_AWARDS;
				$this->m_sTitle = "Awards and Honors";
				break;
		}
		if($title != "")
		{
			$this->m_sTitle = $title;
		}
	}
	
	/**
	 * Display publications section
	 */
	private function displayPublications()
	{
		?>			
			<ul class="ns-list-publications"> 
		<?php
		
		// Load last publication
		$publications = Nsplugin_Publication::Load(5);
		if(isset($this->m_aParams['publications']))
			$publications = $this->m_aParams['publications'];
		
		// For each publication found
		foreach($publications as $pub)
		{
			echo '<li class="ns-list-publications-items">';
			$pub->Display();
			echo '</li>';
		}
		
		?>
			</ul>
		<?php
	}
	
	/**
	 * Display followme section
	 */
	private function displayFollowMe()
	{
		/*?>
			<div class="ns-section ns-section-light-grey" style="padding-bottom: 40px;">
				<div class="ns-section-body">
					<h2 class="ns-section-title">
						<span class="ns-section-title-text ns-light-grey">Follow me</span>
						<span class="ns-section-title-block-right ns-light-grey">
							<div class="ns-section-title-link">
								<a href="/">More</a>
							</div>
						</span>
					</h2>
		<?php*/
		?>
					<div style="padding-bottom: 20px; text-align: center;">
						<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=194949407305628";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-follow" data-href="https://www.facebook.com/nschaetti" data-layout="button_count" data-size="large" data-show-faces="true"></div>
						<a href="https://twitter.com/nschaetti" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @nschaetti</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						<style>.ig-b- { display: inline-block; }
.ig-b- img { visibility: hidden; }
.ig-b-:hover { background-position: 0 -60px; } .ig-b-:active { background-position: 0 -120px; }
.ig-b-v-24 { width: 137px; height: 24px; background: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24.png) no-repeat 0 0; }
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
.ig-b-v-24 { background-image: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24@2x.png); background-size: 160px 178px; } }</style>
<a href="https://www.instagram.com/n.schaetti.public/?ref=badge" class="ig-b- ig-b-v-24"><img src="//badges.instagram.com/static/images/ig-badge-view-24.png" alt="Instagram" /></a>
						<a href="https://ch.linkedin.com/pub/nils-schaetti-msc-scl/2b/a56/982">
      
          <img src="https://static.licdn.com/scds/common/u/img/webpromo/btn_viewmy_160x25.png" width="160" height="25" border="0" alt="Voir le profil de Nils Schaetti MSc (SCL) sur LinkedIn">
        
    </a>
					</div>
					<div class="ns-section-col col-right">
						<a data-tweet-limit="3" data-chrome="nofooter noheader transparent" class="twitter-timeline" href="https://twitter.com/nschaetti" data-widget-id="368117013975019520">
							Tweets by @nschaetti
						</a>
						<script>
							!function(d,s,id)
							{
								var js,fjs = d.getElementsByTagName(s)[0], p=/^http:/.test(d.location)?'http':'https';
								if(!d.getElementById(id))
								{
									js = d.createElement(s);
									js.id=id;
									js.src = p + "://platform.twitter.com/widgets.js";
									fjs.parentNode.insertBefore(js,fjs);
								}
								$('.timeline-Tweet--isRetweet').hide();
							}(document,"script","twitter-wjs");
							$('.timeline-Tweet--isRetweet').hide();
						</script>
					</div>
					<div class="ns-section-col col-left">
						<?php echo do_shortcode("[instagram-feed]"); ?>
					</div>
		<?php
		/*
		?>
				</div>
				<div style="clear: both;"></div>
			</div>
		<?php*/
	}
	
	/**
	 * Display category section
	 */
	private function displayCategory()
	{
		// Custom wordpress query
		if(isset($this->m_aParams['per_page']))
		{
			query_posts("cat=" . $this->m_iTermID . "&posts_per_page=" . $this->m_aParams['per_page']);
		}
		else
			query_posts("cat=" . $this->m_iTermID . "&posts_per_page=4");
		
		// Init counter
		$counter = 0;
		
		// Wordpress loop
		if (have_posts()) : 
			while (have_posts()) : the_post(); ?>
				
				<?php
				// Row div
				if($counter % 2 == 0)
				{
					echo '<div class="ns-section-row">';
				}
				?>
					<div class="ns-section-col <?php if($counter % 2 == 0) { echo "col-right"; } else { echo "col-left"; } ?>">
						<a class="ns-article-image-link">
							<figure class="ns-article-image" style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>');">
								<picture>
									<source srcset="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" media="all and (min-width: 992px)" type="image/jpeg">
									<source srcset="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" media="(min-width: 0px)" type="image/jpeg">
								</picture>
							</figure>
							<span class="ns-article-label"><?php echo get_post_meta(get_the_ID(), 'post_tag', true); ?></span>
						</a>
						<div class="ns-article-body">
							<h3 class="ns-article-title">
								<a class="ns-article-title-link" href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<p class="ns-article-infos">
								<div class="ns-article-infos-list">
									<span class="ns-article-infos-date">
										<?php echo get_post_time('l, F j Y, H:i', true); ?>
									</span>
									<span class="ns-article-infos-views">
										<span class="ns-article-infos-image ns-icon-views">
										</span>
										<span class="ns-article-infos-info">
											3
										</span>
									</span>
									<span class="ns-article-infos-share">
										<span class="ns-article-infos-image ns-icon-share">
										</span>
										<span class="ns-article-infos-info">
											3
										</span>
									</span>
									<span class="ns-article-infos-comments">
										<span class="ns-article-infos-image ns-icon-comments">
										</span>
										<span class="ns-article-infos-info">
											<?php echo get_comments_number(get_the_ID()); ?>
										</span>
									</span>
									<div style="clear: both;"></div>
								</div>
							</p>
							<p class="ns-article-abstract">
								<?php echo get_the_excerpt(); ?>
							</p>
						</div>
					</div>
				<?php
				$counter++;
				if($counter % 2 == 0)
				{
					echo '<div style="clear: both;"></div>';
					echo '</div>';
				}
				?>
			<?php endwhile; ?>
			
			<?php
			if($counter % 2 != 0)
			{
				echo '<div style="clear: both;"></div>';
				echo '</div>';
			}
			?>
			
		<?php endif;
	}
	
	/**
	 * Display category section
	 */
	private function displaySCategory()
	{
		// Init counter
		$counter = 0;
		
		// Wordpress loop
		if (have_posts()) : 
			while (have_posts()) : the_post(); ?>
				
				<?php
				// Row div
				if($counter % 2 == 0)
				{
					echo '<div class="ns-section-row">';
				}
				?>
					<div class="ns-section-col <?php if($counter % 2 == 0) { echo "col-right"; } else { echo "col-left"; } ?>">
						<a class="ns-article-image-link">
							<figure class="ns-article-image" style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>');">
								<picture>
									<source srcset="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" media="all and (min-width: 992px)" type="image/jpeg">
									<source srcset="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" media="(min-width: 0px)" type="image/jpeg">
								</picture>
							</figure>
							<span class="ns-article-label"><?php echo get_post_meta(get_the_ID(), 'post_tag', true); ?></span>
						</a>
						<div class="ns-article-body">
							<h3 class="ns-article-title">
								<a class="ns-article-title-link" href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<p class="ns-article-infos">
								<div class="ns-article-infos-list">
									<span class="ns-article-infos-date">
										<?php echo get_post_time('l, F j Y, H:i', true); ?>
									</span>
									<span class="ns-article-infos-views">
										<span class="ns-article-infos-image ns-icon-views">
										</span>
										<span class="ns-article-infos-info">
											3
										</span>
									</span>
									<span class="ns-article-infos-share">
										<span class="ns-article-infos-image ns-icon-share">
										</span>
										<span class="ns-article-infos-info">
											3
										</span>
									</span>
									<span class="ns-article-infos-comments">
										<span class="ns-article-infos-image ns-icon-comments">
										</span>
										<span class="ns-article-infos-info">
											<?php echo get_comments_number(get_the_ID()); ?>
										</span>
									</span>
									<div style="clear: both;"></div>
								</div>
							</p>
							<p class="ns-article-abstract">
								<?php echo get_the_excerpt(); ?>
							</p>
						</div>
					</div>
				<?php
				$counter++;
				if($counter % 2 == 0)
				{
					echo '<div style="clear: both;"></div>';
					echo '</div>';
				}
				?>
			<?php endwhile; ?>
			
			<div class="ns-nav-row">
				<div class="ns-newer-articles"><?php next_posts_link( 'Older posts' ); ?></div>
				<div class="ns-older-articles"><?php previous_posts_link( 'Newer posts' ); ?></div>
			</div>
			
			<?php
			if($counter % 2 != 0)
			{
				echo '<div style="clear: both;"></div>';
				echo '</div>';
			}
			?>
			
		<?php endif;
	}
	
	/**
	 * Display projects section
	 */
	public function displayProjects()
	{
		?>
					<!--<img id="ns-project-background-image" src="/wp-content/themes/nstheme/images/background_chateau.jpg" style="left: -47%; position: absolute; height: 104%; z-index: 0;"/>
					<img id="ns-project-image" src="/wp-content/themes/nstheme/images/chateau.png" style="left: -47%; position: absolute; height: 104%; z-index: 0;"/>-->
					
					<div style="position: absolute; top: 35%">
						<h2 class="ns-project-title">
							BeBopBrain<br/>3D Web Platform
						</h2>
						<p class="ns-project-desc">
							Step inside the neonatel brain with BeBeopBrain and<br/>
							BeBopBrain VR and get a look at the different part of<br/>
							the neural system through different ages. You can use<br/>
							your hand movement to explore, aim, and interact - it's<br/>
							a entirely new way to learn.
						</p>
						<div>
							<button class="ns-button ns-button-white" style="margin-left: 65px;">More about</button>
						</div>
					</div>
					
					<img style="position: absolute; right: 50px; top: 50%;" id="nextProject" class="switchHeaderButton ns-next-project" src="wp-content/themes/nstheme/images/next.png" width="23" height="36"/>
		<?php
	}
	
	/**
	 * Display media section
	 */
	public function displayMedias()
	{
		/*?>
			<div class="ns-section ns-section-dark-grey">
				<div class="ns-section-body">
					
					<h2 class="ns-section-title">
						<span class="ns-section-title-text ns-dark-grey">Médias</span>
						<span class="ns-section-title-block-right ns-dark-grey">
							<div class="ns-section-title-link">
								<a href="/">More</a>
							</div>
						</span>
					</h2>
		<?php*/
		?>
					<div class="ns-gallery-header-container">
						<div class="ns-gallery-header-video">
							<video width="600" height="340" controls>
								<source src="http://nilsschaetti/wp-content/uploads/2016/07/neo3d.mp4" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
						<div class="ns-gallery-header-info">
							<h2>ENT3D Demonstration video</h2>
							<div class="ns-gallery-header-time">
								<a>
									<time datetime="2016-07-20T19:30:16Z">
										mercredi 20 juillet à 21:30
									</time>
								</a>
							</div>
							<div>
								Step inside the neonatel brain with BeBeopBrain and
								BeBopBrain VR and get a look at the different part of
								the neural system through different ages. You can use
								your hand movement to explore, aim, and interact - it's
								a entirely new way to learn.
							</div>
						</div>
						<div style="clear: both;"></div>
					</div>
					<div class="ns-gallery-body">
						<div class="ns-gallery-body-medias">
							<table class="ns-gallery-medias-table" cell-spacing="0" cell-padding="0">
								<tr>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/building-dreams-2.png');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/MachineLearningMarketing-1.jpg');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/garden1-3.jpg');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/DSCN0078-2-e1472942069368.jpg');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/IMG_20160417_015307-1-e1472942127673.jpg');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/IMG-20150412-WA0001-1.jpg');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/logo512-1.png');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
									<td>
										<div class="ns-gallery-media" style="background-image: url('http://nilsschaetti/wp-content/uploads/2016/09/IMG_20141024_231316-1.jpg');">
											<div class="ns-gallery-media-hover">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
									<td>
										<div class="ns-gallery-media">
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="ns-gallery-body-more">
							<button class="ns-button-white" style="margin-left: 400px;">More media</button>
						</div>
					</div>
		<?php
		/*
		?>
				</div>
			</div>
		<?php*/
	}
	
	/**
	 * Display about me section
	 */
	public function displayAboutMe()
	{
		?>
					
					<div style="">
						
						<div style="width: 350px; float: left; background-image: url('/wp-content/themes/nstheme/images/back_blue.png');">
							
							<div style="margin-left: 90px; margin-top: 70px; padding: 10px; width: 150px; height: 150px; background-color: #ddf5ff; border-radius: 90px;">
								<div style="background-size: cover; width: 150px; height: 150px; border-radius: 75px;  background-image: url('<?php do_action('nsplugin_get_about_field','image_me'); ?>');">
								</div>
							</div>
							
							<h2 style="color: #aaa; text-align: center; font-weight: normal; margin-top: 50px; margin-bottom: 40px;">
								ABOUT ME
							</h2>
							
							<div style="border-top: solid 1px #ddd;margin-left: 50px; margin-right: 50px; margin-bottom: 15px;">
							</div>
							
							<div style="padding: 30px; text-align: left; color: #888; font-weight: normal;">
								<b>Name</b> : <?php do_action('nsplugin_get_about_field','name'); ?><br/>
								<b>Firstname</b> : <?php do_action('nsplugin_get_about_field','firstname'); ?><br/>
								<b>Birthday</b> : <?php do_action('nsplugin_get_about_field','birthday'); ?><br/>
								<b>Citizen</b> : <?php do_action('nsplugin_get_about_field','citizenship'); ?><br/>
								<b>Place</b> : <?php do_action('nsplugin_get_about_field','place'); ?><br/> 
								<b>Favorites languages</b> : <?php do_action('nsplugin_get_about_field','favorite_languages'); ?><br/>
								<b>Current position</b> : <?php do_action('nsplugin_get_about_field','position'); ?><br/>
								<b>Past position</b> : <?php do_action('nsplugin_get_about_field','former_position'); ?><br/>
								<b>Favorite book</b> : <?php do_action('nsplugin_get_about_field','favorite_book'); ?><br/>   
							</div>
							
						</div>
						
						<div style="height: 500px; width: 20px; border-right: solid 1px #ddd; float: left;">
						</div>
						
						<div style="float: left;width: 489px; padding-left: 20px;">
							<div style="padding-top: 80px; padding-bottom: 80px; padding-left: 60px; padding-right: 60px; text-align: center; width: 100%; background-color: #000; background-image: url('<?php do_action('nsplugin_get_about_field','about_image'); ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
								<div style="border: solid 1px #fff; padding: 20px;">
									<div style="background-color: #fff; margin-top: 10px; margin-top: 10px;">
										<h1 style="color: <?php do_action('nsplugin_get_about_field','quote_color'); ?>; font-size: 20px; letter-spacing: 2px; padding-top: 15px; font-weight: normal;">
											Favorite Quote:
										</h1>
										<h2 style="color: <?php do_action('nsplugin_get_about_field','quote_color'); ?>; font-size: 18px; letter-spacing: 2px; padding-bottom: 15px; font-weight: normal;">
											"<?php do_action('nsplugin_get_about_field','favorite_quote'); ?>"
										</h2>
									</div>
								</div>
							</div>
							<div style="height: 20px;"></div>
							<div style="color: #888; font-size: 16px; width: 609px;">
								<!--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget tempus leo. Donec sed fringilla massa, varius vulputate metus. Duis non tincidunt orci. Aliquam elementum lorem felis, at pretium justo semper eu. Fusce vitae erat viverra, molestie ipsum blandit, sagittis nulla. Etiam varius eget ipsum eget porta. Donec pretium sagittis ullamcorper.<br/>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget tempus leo. Donec sed fringilla massa, varius vulputate metus. Duis non tincidunt orci. Aliquam elementum lorem felis, at pretium justo semper eu. Fusce vitae erat viverra, molestie ipsum blandit, sagittis nulla. Etiam varius eget ipsum eget porta. Donec pretium sagittis ullamcorper.<br/>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget tempus leo. Donec sed fringilla massa, varius vulputate metus. Duis non tincidunt orci. Aliquam elementum lorem felis, at pretium justo semper eu. Fusce vitae erat viverra, molestie ipsum blandit, sagittis nulla. Etiam varius eget ipsum eget porta. Donec pretium sagittis ullamcorper.<br/>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget tempus leo. Donec sed fringilla massa, varius vulputate metus. Duis non tincidunt orci. Aliquam elementum lorem felis, at pretium justo semper eu. Fusce vitae erat viverra, molestie ipsum blandit, sagittis nulla. Etiam varius eget ipsum eget porta. Donec pretium sagittis ullamcorper.-->
								<?php do_action('nsplugin_get_about_field','bio'); ?>
							</div>
						</div>
						
						<div style="clear: both;"></div>
						
					</div>
					
					<div style="clear: both;"></div>
		<?php
	}
	
	/**
	 * Display education section
	 */
	public function displayEducation()
	{
		// Show education
		do_action("nsplugin_show_education");
	}
	
	/**
	 * Display working experience
	 */
	public function displayWork()
	{
		// Show working experience
		do_action("nsplugin_show_working_experiences");
	}
	
	/**
	 * Display awards
	 */
	public function displayAwards()
	{
		do_action("nsplugin_show_awards");
	}
	
	/**
	 * Display links section
	 */
	public function displayLinks()
	{
		?>
		<h3 style="font-weight: normal; padding: 12px; text-align: center;">
			Follow me on Facebook, Twitter, Instagram and LinkedIn
		</h3>
		<div style="padding-bottom: 20px; text-align: center;">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=194949407305628";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-follow" data-href="https://www.facebook.com/nschaetti" data-layout="button_count" data-size="large" data-show-faces="true"></div>
			<a href="https://twitter.com/nschaetti" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @nschaetti</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			<style>.ig-b- { display: inline-block; }
.ig-b- img { visibility: hidden; }
.ig-b-:hover { background-position: 0 -60px; } .ig-b-:active { background-position: 0 -120px; }
.ig-b-v-24 { width: 137px; height: 24px; background: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24.png) no-repeat 0 0; }
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
.ig-b-v-24 { background-image: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24@2x.png); background-size: 160px 178px; } }
			</style>
			<a href="https://www.instagram.com/n.schaetti.public/?ref=badge" class="ig-b- ig-b-v-24">
				<img src="//badges.instagram.com/static/images/ig-badge-view-24.png" alt="Instagram" />
			</a>
			<a href="https://ch.linkedin.com/pub/nils-schaetti-msc-scl/2b/a56/982">
				<img src="https://static.licdn.com/scds/common/u/img/webpromo/btn_viewmy_160x25.png" width="160" height="25" border="0" alt="Voir le profil de Nils Schaetti MSc (SCL) sur LinkedIn">
			</a>
		</div>
		<h3 style="font-weight: normal; padding: 12px; text-align: center;">
			You can also contact me directly by mail
		</h3>
		<center>
			<button class="ns-button ns-button-black" style="margin: 8px;">
				Email me
			</button>
		</center>
		<?php
	}
	
	/**
	 * Display pub. key
	 */
	public function displayPubKey()
	{
		?>
		<div class="ns-pubkey-container" id="pubkey">
		-----BEGIN PGP PUBLIC KEY BLOCK-----<br/>
Version: GnuPG v1<br/>
<br/>
mQENBFY36KABCADQpDW1N7FAVcEl/I/bbIGE9BxOIPLUDxBKSyqK7zXv7b/riw5U<br/>
fOhZk/f5mb6tK084X5anyeUs8R2U6AIWobaYM/x0iOmFIGNnhWFSZmtDqcV16ydz<br/>
igpicIdg98u89oMd4IMfyQNXCnu3qslctuQtinXdLDhH3V8m/fVRwuEyp04i66Jj<br/>
z7leUu+nsz4VQnf1BF4+D9GmHzM8DjnVAijl66+RfME3H3ifxBkkgcoT6BDPo0dS<br/>
YGM+w7sB03UdTKhPyCakg25nYImo6lE+OfcdUja/neUnBk3+chsWGbvXdMLqoXVy<br/>
Nv5MUUHI6bcK7nTVhLJN7B6RoDOzIpweSgcJABEBAAG0JE5pbHMgU2NoYWV0dGkg<br/>
PG4uc2NoYWV0dGlAZ21haWwuY29tPokBOAQTAQIAIgUCVjfooAIbAwYLCQgHAwIG<br/>
FQgCCQoLBBYCAwECHgECF4AACgkQemXI3SwCw7HtiQf+Lcrr+OBlfZxuv6T0VRd5<br/>
M9CwfKCLxUoTyC7//t3cz0zFBWah8BQhELxyC0moFpnhuTEvO+VTUEeNA9op8m/I<br/>
T9kU+u6EJEWBnfCrS5ryA8sQGq70Javv2xZem+qGdKGeW1x+GO7JZ7YOxJgLiC56<br/>
xsIUNudXocP8tPJJ0ew3aGrtYundaQIZ/do6CKGVZUrFHcyxjWLYULLNFNuKpAeE<br/>
PdWC52wfZzi6jeM9hjf3iNYOGvpHTme1yyOGJt2bsJmr2DxttIPPmpfymx96rXw7<br/>
VrnE/x60T0DBpTaKXhHlECgXYxp6pbCwWBFEJrNHD/v7SQfSWvhxrsls2B9FiNl/<br/>
oLkBDQRWN+igAQgAtZVddjIDP2kY0pu83qthpDUxQlNHNLj+HU8o3ERUX88L7Etp<br/>
l60iH9CR3QTgguCIhvvc5V95jVj8HG0itZXJBlICAfhuvr78gT7GBubndTBFs3p0<br/>
rrXbRaVc1kF39PHL/mwFpljkpwu80QCJ4D7jUGcbvnNQSQMN2SlHPuKyLqICpcVy<br/>
D/Y0gY7r7SDi5AaG7HiuHOUlZe78JNAEJpvnQe5LtpqKKJ56yFyum3QK6oE7A0Uo<br/>
7ulkVaGS8mTCd+2dWKIt7ZbLotigZ5V5H/GHLKXSQwWg6/g5HdjpdrcKSzB7Ss9i<br/>
gNYfonUqeVhh+nAuz6L5zHGHIN/rI/Z9dPZPgQARAQABiQEfBBgBAgAJBQJWN+ig<br/>
AhsMAAoJEHplyN0sAsOxP2gIAJj24feHh/Xa5x+XLHCg5Er8Qw3JWJWRvZK/Dzww<br/>
On9GpcPRT6e3Rqvv5wDWJuhyVfGpAPJu4ecIOv3pN3qLH5hgC3ILiVKgG2FQaC2Y<br/>
46trEpRGkro+mt9KFl6KWnPOHvdfhFih1lf1rsXzn2vOIXOmPwK2045X/ml96C6A<br/>
rdQasoCP3vRB9rw/A6um/RWk/DZ2bH/KxJ0iHMW6fX+ua6j+VQ9YOx4blgIAHAKF<br/>
4CS4O9+L/fovteSuopmdV8BmMJGxrVwf194oTCOiy6PgAl4zjydapJDnVPn9QLNX<br/>
8lhRoEQlI53+CwDo5ky40tjVZ3CHrh5zj0J/SMStHDJFQO+ZAQ0EVpgWmgEIAIhg<br/>
qi+4WP0k7524wSDIIoFGRCRtFot9/SmusKEaSoS9997TcW3mXaHltreZOQ5q/y11<br/>
o1ERG6l6TwRU4KOkLc1Zr67RVr91ghxW5iBp5QIR75OeBAEN5GEYK10fuifl3I9I<br/>
dgtgGpiAALV2SpXPT5PAawEe3Xm128Osv9n5Mv8sIBQ6wOi+SHIRWCAOp4e28s1g<br/>
IcPD/CkKel7Q/lpqOJ0fM1+X07e9rCgCd+sScOaasslvUyYWZyIYGnAmL3Cg7kdT<br/>
bgfFymgn95PgxSefw5u6/AakOH6grpChT+dAyQyrcqHBrNeYz4OsSPNj27wpwjOy<br/>
5snkhO+NC7XaRlI0LQ0AEQEAAbQsTmlscyBSb211YWxkIFNjaGFldHRpIDxuLnNj<br/>
aGFldHRpQGdtYWlsLmNvbT6JATgEEwECACIFAlaYFpoCGwMGCwkIBwMCBhUIAgkK<br/>
CwQWAgMBAh4BAheAAAoJEO7GhbFOi2xyg/IH/3z+fy2iQ9FLpv8RAZM9mJpyxGF0<br/>
/IlQsCZ+gY1Gf8r0J7kyH6lS7tN+zyeIDBHWkU54aIUUI5ZyPqLnNI77/TGA5sp4<br/>
GzQZzNNzV/b1YvUrqXpjPSJj3crqUJkilfQSh8c6cb6dwfDcOYzzC6Wi70HiDF/G<br/>
mDsyy8pYP/DLHFTxtRSxbwjx5gtvxyI8hRc0qmTGbkgHm4y5hTbuO2UlsMo8o+R0<br/>
ZWJvcQn8/9/c6PjPEUyfCDkIXLuBMkUYriHakNR94wQ2Ov7SfVnXp6Mmy8qXFC6Z<br/>
gNQn+HdgEN6Ium7tZ1mhMir+KF/Ted6gfm5/02DmSg4pkXwsKEuuS/gaedW5AQ0E<br/>
VpgWrwEIAK3KEV+EDh0vZYwRtFOC3NNjfRldJrzomTgBj4P5LNRf1aMq/yXKV3RA<br/>
cAN/xWlbzKk5E35CBMQutJVvmxgCWarSvw25p2vx8NsryKnmSy3mu2oikPP4FvLc<br/>
XmWjVlBaOD4L3Un96J8KNmWAMnjguDGX2ZsQ06KYcRFFd7lZnPXCHaHTZ0Vg4zjp<br/>
GIrSkM2NELRDh/IbChUnD6nuvs7I3TR90/82R/ID61GOO17bTlIIZ+WzIkfPauVA<br/>
MrYOEmmCiosv9tyH1lx546ZUd/PyPZwo3guKt4s/zo9sQ421/l5Xv0KV+Wzp6KfB<br/>
D+x0TSfwo+G3RA4pP0+i8qkcGxP4zZ8AEQEAAYkBHwQYAQIACQUCVpgWrwIbIAAK<br/>
CRDuxoWxTotscrpLB/9bvaduelHOJ+/VzjSsAZYXgj8fnyhtvz5K6w4gSUYH9UbH<br/>
lb+K9l7TUY+bWotTDnDja0GMpGYJMr8JFtYGutWw8XVeC4VpgMwNGWMm/BJoaePh<br/>
8D5/0jzskWBTt/DT1jDuOjtpE4JepExvVaeKYXQgQCjbh/MkX0Hml7JL1mehhAJD<br/>
mSLy8iZWicj2P+c9MS438ewJTqHkVF/G2zws8wAGfD/LLlqsp+/1S/+M7XHJpvhE<br/>
8Tn8dV1sN4SE8NNIdJEUctKQWxhNKYg2r4b73rlHc4yyiA8xaVmHE5TJKR4YnQqZ<br/>
UA2gchTmQawAaZrnCjmH/QFHTzSMY/spa1ecERTiuQENBFaYFq8BCADRpEolm2/r<br/>
rCpHyPWJTQjelHRLgkB223zKjDIOyYB8XjS39cv0rrE4iwHNASJ/SaQgqWqMntxh<br/>
jiKdT6LMM4Ph/WJyVcsdDMAfAgdmgGyCqayb1gClB7QSts/xX1GuuPUjEz49PkKy<br/>
2kPWFfqY7ftIa954NcZX/G6OYcdkMxNDXvQi/KDCJnmAGhfzbVij3vKwBlfiI2RE<br/>
G+D5G0jZILvrY/gGP9iGECVhWFrMsEuIKqgk/zC9bzFWMvODoOzpzN7gtFBcRHlM<br/>
nJ+Gbz7Syu0ZOXHc6yb1QXzKSYB4v3WztE83+nanzGqOu+1byfZvoNSfgzDd38i6<br/>
DqWSr5ks+DGLABEBAAGJAR8EGAECAAkFAlaYFq8CGwwACgkQ7saFsU6LbHJtbQf+<br/>
L6oAEdtqkeI5+YqO2PcL8eWznoLQ9FullqtRtZBSMq8PQGRuqvnMkr2bqPm/HfG9<br/>
dz+KH8lKXn/Vrs8ArM1V4hWyKEe80K+9NFOY2d73N+zd/eGtySNb8zaV+pfQfz+b<br/>
2Gy2rFRusmvpzLMGbTu7jhzme1eo09WBbv7hXGDSnhRRgdtJ1Nc1EfYu2/+rWc22<br/>
XPF6hLfk0AysU3bJ1S/KasPnH9SQ3qa9mcPOCj0HH+MtSpoXp5lmIskdxhX+6lzq<br/>
ufSCTtIqBHc8PhFNQyJrxFi+HWZjpzSgfCoiQvKcADcv3s6wv/CSpDlZ+SA0XDyf<br/>
NWbhCn+STHaK44pREJc8kg==<br/>
=KD2r<br/>
-----END PGP PUBLIC KEY BLOCK-----
		</div>
		<button class="ns-button ns-button-black ns-clipboard-btn" style="margin: 8px;" data-clipboard-target="#pubkey">
			Copy to clipboard
		</button>
		<?php
	}
	
	/**
	 * Display contact form
	 */
	public function displayContact()
	{
		?>
		<table style="width: 100%;">
			<tr>
				<th scope="row">
					<label for="mailName">Name</label>
				</th>
				<td>
					<input name="mailName" type="text" id="mailName" value="" class="ns-text-field" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="mailSubject">Subject</label>
				</th>
				<td>
					<input name="mailSubject" type="text" id="mailSubject" value="" class="ns-text-field" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="mailContact">Email</label>
				</th>
				<td>
					<input name="mailContact" type="text" id="mailContact" value="" class="ns-text-field" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="mailMessage">Message</label>
				</th>
				<td>
					<textarea name="mailMessage" id="mailMessage" class="ns-text-field" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<th scope="row">
				</th>
				<td style="text-align: right;">
					<button class="ns-button ns-button-white ns-send-message-btn" style="margin: 8px;">
						Send
					</button>
				</td>
			</tr>
		</table>
		<?php
	}
	
	/**
	 * Display parent categories
	 */
	public function displayParentCategories()
	{
		global $wpdb;
		
		?>
		<table cellpadding="0" cellspacing="0" style="padding: 0; margin: 0;">
			<tr>
		<?php
		
		foreach($this->m_aParams['term_ids'] as $term_id)
		{
			// Get image's URL
			if(count(get_term_meta($term_id,"term_media")) > 0)
			{
				// Get GUID
				$id = get_term_meta($term_id,"term_media")[0];
				$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = $id;");
				if(count($data) > 0)
				{
					$guid = $data[0]->guid;
					$src = $guid;
				}
				else
				{
					$src = "";
				}
			}
			else
			{
				{
					$src = "";
				}
			}
			//echo $term_id;
			?>
				<td class="ns-parent-categories-item" onClick="window.location.href = '/index.php/category/<?php echo get_term_by('id', $term_id, 'category')->slug; ?>/';" style="background-image: url('<?php echo $guid; ?>');">
					<div class="layer">
						<div class="container">
							<h2>ARTICLES</h2>
							<h1><?php echo get_term_by('id', $term_id, 'category')->name; ?></h1>
						</div>
					</div>
				</td>
			<?php
		}
		
		?>
			</tr>
		</table>
		<?php
	}
	
	public function displayProject()
	{
		global $wpdb;
		$project = $this->m_aParams['project'];
		$id = $project->mid;
		$guid = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = $id;")[0]->guid;
		
		// Project's medias
		$medias = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}nsprojectmedia WHERE prid = {$project->id};");
		//var_dump($medias);
		?>
			<div>
				<div style="float: left; width: 200px; padding-top: 0px;">
					<div style="margin-bottom: 15px; vertical-align: top; height: 400px; background-size: cover; background-position: center center; background-image: url('<?php echo $guid; ?>');">
					</div>
				</div>
				<div style="float: right; width: 770px; padding-left: 30px; vertical-align: top;">
					<?php echo str_replace($project->name,"<b>" . $project->name . "</b>", str_replace("\n","<br/>",$project->description)); ?>
				</div>
				<div style="clear: both; height: 20px;"></div>
				<div style="">
					<strong>Started on </strong><?php echo $project->startdate; ?> and <strong>ended on</strong> <?php echo $project->enddate; ?>.
				</div>
				<div style="height: 20px;"></div>
				<?php
				if(!isset($this->m_aParams['show_gallery']) || $this->m_aParams['show_gallery'])
				{
				?>
				<table style="width: 100%;">
					<tr>
						<?php
							for($i=0; $i<4; $i++)
							{
								$media = $medias[$i];
								$mguid = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = {$media->mid};")[0]->guid;
								?>
									<td style="width: 25%;">
										<div class="ns-project-gallery-media" data-media="<?php echo $media->mid; ?>" style="height: 200px; background-image: url('<?php echo $mguid; ?>'); background-position: center center; background-size: cover;">
											<div style="height: 200px;" class="ns-gallery-media-hover ns-gallery-icon-image ns-project-medias-hover">
											</div>
										</div>
									</td>
								<?php
							}
						?>
					</tr>
				</table>
				<div style="height: 20px;"></div>
				<?php
				}
				?>
				<?php
					if(!isset($this->m_aParams['show_more']) || $this->m_aParams['show_more'])
					{
				?>
				<div style="text-align: center;">
					<button class="ns-button ns-button-black ns-send-message-btn" style=""  onClick="window.location.href = '<?php echo $project->internalurl; ?>';">
						More about <?php echo $project->name; ?>
					</button>
				</div>
				<?php 
					}
				?>
			</div>
		<?php
		if(isset($this->m_aParams['show_content']) && $this->m_aParams['show_content'])
		{
			the_content();
		}
	}
	
	public function displayResearch()
	{
		global $wpdb;
		$research = $this->m_aParams['research'];
		$id = $research->mid;
		$guid = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE ID = $id;")[0]->guid;
		?>
			<div>
				<div style="float: left; width: 200px; padding-top: 0px;">
					<div style="vertical-align: top; height: 400px; background-size: cover; background-position: center center; background-image: url('<?php echo $guid; ?>');">
					</div>
				</div>
				<div style="float: right; width: 770px; padding-left: 30px; vertical-align: top;">
					<?php echo str_replace($research->name,"<b>" . $research->name . "</b>", str_replace("\n","<br/>",$research->description)); ?>
				</div>
				<div style="clear: both; height: 20px;"></div>
				<?php
					if(!isset($this->m_aParams['show_pub']) || $this->m_aParams['show_pub'])
					{
						// Load last publication
						$publications = Nsplugin_Publication::getByCategory($research->term_id, 5);
						if(isset($this->m_aParams['publications']))
							$publications = $this->m_aParams['publications'];
						
						if(count($publications) > 0)
						{
							?>
							<div style="padding-top: 5px; padding-bottom: 15px; color: #656565; font-size: 24px; font-weight: bold;">
								Publications
							</div>
							<div>		
								<ul class="ns-list-publications"> 
								<?php
								
								// For each publication found
								foreach($publications as $pub)
								{
									echo '<li class="ns-list-publications-items">';
									$pub->Display();
									echo '</li>';
								}
								
								?>
								</ul>
							</div>
							<?php
						}
					}
					if(!isset($this->m_aParams['show_more']) || $this->m_aParams['show_more'])
					{
				?>
				<div style="text-align: center;">
					<button class="ns-button ns-button-black ns-send-message-btn" style=""  onClick="window.location.href = '<?php echo $research->links; ?>';">
						More about <?php echo $research->name; ?>
					</button>
				</div>
				<?php 
					}
				?>
			</div>
		<?php
		if(isset($this->m_aParams['show_content']) && $this->m_aParams['show_content'])
		{
			the_content();
		}
	}
	
	private function displaySmallGallery()
	{
	}
	
	/**
	 * Dislay the section
	 */
	public function display()
	{
		$color = $this->m_iColor;
		$classes = array(SECTION_COLOR_WHITE => "ns-white", SECTION_COLOR_LIGHTGREY => "ns-light-grey", SECTION_COLOR_DARKGREY => "ns-dark-grey");
		$sectionclass = array(SECTION_COLOR_WHITE => "", SECTION_COLOR_LIGHTGREY => "ns-section-light-grey", SECTION_COLOR_DARKGREY => "ns-section-dark-grey");
		$lineclass = array(SECTION_COLOR_WHITE => "ns-section-title-line-dark", SECTION_COLOR_LIGHTGREY => "ns-section-title-line-dark", SECTION_COLOR_DARKGREY => "ns-section-title-line-light");
		
		// Type class
		$typeclass = "";
		$bodyclass = "";
		$bodydata = "";
		$containerclass = "";
		switch($this->m_iType)
		{
			case SECTION_TYPE_PROJECTS:
				$typeclass = "ns-project-section";
				break;
			case SECTION_TYPE_MEDIAS:
				$typeclass = "ns-media-section";
				$bodyclass = "ns-gallery";
				$bodydata = "data-gallery=\"{$this->m_iGID}\" data-width=\"8\" data-height=\"2\"";
				break;
			case SECTION_TYPE_PCATEGORY:
				$typeclass = "ns-parent-category-section";
				$containerclass = "ns-parent-category-section-container";
				$bodyclass = "ns-parent-category";
				break;
		}
		
		?>
			<div class="ns-section-background">
				<div class="ns-section <?php echo $typeclass; ?> <?php echo $sectionclass[$color]; ?> <?php echo $classes[$color]; ?> ns-project-background-image1">
					<div class="ns-section-container  <?php echo $containerclass; ?>">
		<?php
		
		if($this->m_iType != SECTION_TYPE_PCATEGORY)
		{
		?>
						<div class="ns-section-title <?php echo $classes[$color]; ?>">
							
							<table cell-spacing="0" cell-padding="0" style="width: 100%; border-spacing: 0px;" border-width="0">
								<tr>
									<td class="ns-section-title-cell ns-section-title-title"><?php echo $this->m_sTitle; ?></td>
									<td class="ns-section-title-line <?php echo $lineclass[$color]; ?>"></td>
									<td class="ns-section-title-cell ns-section-title-more">
										<a href="/index.php/category/<?php echo $this->m_sLink; ?>"><?php echo ($this->m_sLink != "") ? "More" : ""; ?></a>
									</td>
								</tr>
							</table>
							
						</div>
		<?php
		}
		
		?>
						<div class="<?php echo $bodyclass; ?> ns-section-body" <?php echo $bodydata; ?>>
		<?php
		
		// Section type
		switch($this->m_iType)
		{
			case SECTION_TYPE_PUBLICATIONS:
				$this->displayPublications();
				break;
			case SECTION_TYPE_FOLLOWME:
				$this->displayFollowMe();
				break;
			case SECTION_TYPE_CATEGORY:
				$this->displayCategory();
				break;
			case SECTION_TYPE_PROJECTS:
				$this->displayProjects();
				break;
			case SECTION_TYPE_MEDIAS:
				$this->displayMedias();
				break;
			case SECTION_TYPE_ABOUTME:
				$this->displayAboutMe();
				break;
			case SECTION_TYPE_EDUCATION:
				$this->displayEducation();
				break;
			case SECTION_TYPE_WORKEXP:
				$this->displayWork();
				break;
			case SECTION_TYPE_AWARDS;
				$this->displayAwards();
				break;
			case SECTION_TYPE_LINKS:
				$this->displayLinks();
				break;
			case SECTION_TYPE_CONTACT:
				$this->displayContact();
				break;
			case SECTION_TYPE_PUBKEY:
				$this->displayPubKey();
				break;
			case SECTION_TYPE_SCATEGORY:
				$this->displaySCategory();
				break;
			case SECTION_TYPE_PCATEGORY:
				$this->displayParentCategories();
				break;
			case SECTION_TYPE_RESEARCH:
				$this->displayResearch();
				break;
			case SECTION_TYPE_PROJECT:
				$this->displayProject();
				break;
			case SECTION_TYPE_SGALLERY:
				$this->displaySmallGallery();
				break;
		}
		
		// End
		?>
						</div>
					</div>
					
					<?php
						/*if($this->m_iType == SECTION_TYPE_PROJECTS)
						{
							?>
								<img id="ns-project-background-image" src="/wp-content/themes/nstheme/images/background_chateau.jpg" style="left: -47%; position: absolute; height: 104%; z-index: 0;"/>
								<img id="ns-project-image" src="/wp-content/themes/nstheme/images/chateau.png" style="left: -47%; position: absolute; height: 104%; z-index: 0;"/>
							<?php
						}*/
						?>
					
					<div style="clear: both;"></div>
				</div>
			</div>
		<?php
	}
	
	/***************************************
	 * Load functions
	 ***************************************/
	
	/**
	 * Load sections
	 */
	public static function loadSections()
	{
		global $wpdb;
		$cat_array = array();
		
		// Get all sections
		$sections = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}nssections s, {$wpdb->prefix}terms t WHERE s.term_id = t.term_id ORDER BY position;");
		
		// For each of those
		foreach($sections as $section)
		{
			array_push($cat_array, new Nsplugin_Home_Section($section->id, $section->position, $section->type, $section->term_id, ($section->type == SECTION_TYPE_CATEGORY) ? $section->name : "", $section->slug, $section->term_group, $section->color, $section->gid));
		}
		
		return $cat_array;
	}
	
}
