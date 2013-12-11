<?php
/*
Section: Social Bar
Author: PageLines
Author URI: http://pagelines.com
Description: Simple Social Bar with most of the common social media websites
Filter: component, social
Loading: active
Class Name: PLSocialBar
Edition: pro
*/

class PLSocialBar extends PageLinesSection {

	function section_opts()
	{
		$options = array(
			array(
				'key' => 'social_url',
				'type'			=> 'multi',
				'title'			=> __('Social Sites URL ex.http://www.site.com', 'pagelines'),
				'label'		=> __('In the follow fields please, enter the social URL, if the URL field is empty, nothing will show.', 'prettyphoto'),
				'opts'	=> $this->social_fields()
			),
		);
		return $options;
	}
	
	function section_head(){ ?>
		<script>
		jQuery(document).ready(function($) {
			jQuery(".menu a").tooltip({
				placement:"top"
			});

		});
		</script>
		<?php 
	}

 	function section_template()
 		{
			$socials    = array();
			foreach ($this->get_valid_social_sites() as $key => $social) {
				if( $this->opt( $social . '-url' ) ){
					array_push($socials, array('site' => $social, 'url' => $this->opt( $social . '-url' )));
				}
			}
 	?>
				<div class="icons">
						<ul class="menu">
							<?php foreach ($socials as $social): ?>
								<li class="<?php echo $social['site'] ?>">
									<a href="<?php echo $social['url'] ?>" title="<?php echo ucfirst($social['site']) ?>" target="_blank"></a>
								</li>
							<?php endforeach ?>
						</ul>
						<div class="clear"></div>
				</div>
	<?php
 	}

	function social_fields()
	{
		$out = array();
		foreach ($this->get_valid_social_sites() as $social => $name)
		{
			$out[$name . '-url'] = array(
				'key' => $name . '-url',
				'label' => __(ucfirst($name)),
				'type' => 'text'
			);
		}
		return $out;
	}

	function get_valid_social_sites()
	{
		return array("facebook","twitter","googleplus","dribbble","instagram","behance","youtube","digg","flickr","forrst","html5","lastfm","linkedin","paypal","picasa","pinterest","rss","skype","stumbleupon","tumblr","vimeo","wordpress","yahoo"
		);
	}


}