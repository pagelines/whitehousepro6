<?php
/*
	Section: WhiteHousePro Footer
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: WhiteHousePro stylized footer area with enhanced social icons and widgets.
	Class Name: WHPFooter
*/

class WHPFooter extends PageLinesSection {
	
	function section_opts(){

		$social_urls = array(); 
	
		$social_icons = $this->social_icons();
		
		foreach($social_icons as $icon){
			$social_urls[] = array(
				'label'	=> ui_key($icon) . ' URL', 
				'key'	=> 'whpfooter_'.$icon,
				'type'	=> 'text',
				'scope'	=> 'global',
			); 
		}

		$nav_options = array(); 
		
		for( $i = 1; $i <= 4; $i++ ){
			
			$nav_options[] = array(
									'key'			=> 'whpfooter_nav_title_'.$i,
									'type'			=> 'text',
									'label'		 	=> sprintf( __( 'Nav %s | Title', 'pagelines' ), $i ),
								);
			
			$nav_options[] = array(
									'key'			=> 'whpfooter_nav_menu_'.$i,
									'type'			=> 'select_menu',
									'label'		 	=> sprintf( __( 'Nav %s | Select Menu', 'pagelines' ), $i ),
								);
			
			$nav_options[] = array(
									'type'			=> 'divider',
								);
			
		}

		$options = array(

			array(
				'type'	=> 'multi',
				'key'	=> 'whpfooter_social',
				'title'	=> __( 'Social Icons', 'pagelines' ),
				'col'	=> 1,
				'opts'	=> array(
					array(
						'type'	=> 'multi',
						'key'	=> 'whpfooter_social_urls', 
						'title'	=> 'Link URLs',
						'opts'	=> $social_urls,
					),
					array(
						'type'		=> 'check',
						'key'		=> 'whpfooter_social_disable',
						'label'		=> __( 'Hide Social Icons?', 'pagelines' ),
						'default'	=> false
					),
				)

			),

			array(
				'type' 			=> 'multi',
				'title' 		=> __( 'Navigation Columns', 'pagelines' ),
				'col'			=> 2,
				'opts'			=> $nav_options,
			),

		 	array(
				'type' 			=> 'multi',
				'title' 		=> __( 'Bottom Credits', 'pagelines' ),
				'col'			=> 2,
				'opts'			=> array(

					array(
						'key'		=> 'copy',
						'type' 		=> 'text',
						'label' 	=> __( 'Copyright text or similar.', 'pagelines' ),
					),

					array(
						'key'		=> 'tagline',
						'type' 		=> 'text',
						'label' 	=> __( 'Tagline Text', 'pagelines' ),
					),

				)
			),
			
		);

		return $options;

	}
	
	function social_icons( ){
		
		$social_icons = array(
			'facebook',
			'linkedin',
			'instagram',
			'twitter',
			'youtube',
			'google-plus',
			'pinterest',
			'dribbble',
			'flickr',
			'github',
		); 
		
		return $social_icons;
		
	}
	
   function section_template() { 

   		$social_icons = $this->social_icons(); 

   		$hide_social = ( $this->opt('whpfooter_social_disable') ) ? $this->opt('whpfooter_social_disable') : false;
		
		$tagline = ( $this->opt('tagline') ) ? $this->opt('tagline') : 'Designed by PageLines in California.';
		
		$copy = ( $this->opt('copy') ) ? $this->opt('copy') : 'Copyright &copy; 2014 | 1600 Pennsylvania Ave NW, Washington, DC 20500 |';
		
		
		$cols = array(); 
		for( $i = 1; $i <= 4; $i++ ){
			
			$menu =  ( $this->opt('whpfooter_nav_menu_'.$i) ) ? $this->opt('whpfooter_nav_menu_'.$i) : false;
			
			
			
			$cols[ $i ] = array(
				'menu'		=> false, 
				'title'		=> false
			);
			
			if( $menu && is_array( wp_get_nav_menu_items( $menu ) ) ){
				$args = array(
					'menu'            	=> $menu,
					'echo'            	=> false,
					'items_wrap'      	=> '%3$s',
					'container'			=> ''
				);
				$cols[ $i ]['menu'] = wp_nav_menu( $args );
			}
				
			
			$cols[ $i ]['title'] = ( $this->opt('whpfooter_nav_title_'.$i) ) ? $this->opt('whpfooter_nav_title_'.$i) : false;
		
		}
		
	
	?>
	

		<?php if( '1' !== $hide_social ): ?>
			<div class="icons row fix">
				<?php 
				
				foreach($social_icons as $icon){
				
					$url = ( pl_setting('whpfooter_'.$icon) ) ? pl_setting('whpfooter_'.$icon) : false;
				
					if( $url )
						printf('<a href="%s" class="whpfooter-link" target="_blank"><i class="icon icon-%s"></i></a>', $url, $icon); 
				}
			
				?>
			</div>
		<?php endif; ?>
		<div class="row fix pl-shadow-wrap">
				<div class="span3">
					<?php 
					
						$title = ( $cols[1]['title'] ) ? $cols[1]['title'] : __('Pages','pagelines'); 
						$menu = ( $cols[1]['menu'] ) ? $cols[1]['menu'] : pl_list_pages(); 
						
						echo pl_media_list( $title, $menu ); 
					?>
					
				</div>
				<div class="span3">
					<?php 
					
						$title = ( $cols[2]['title'] ) ? $cols[2]['title'] : __('Categories','pagelines'); 
						$menu = ( $cols[2]['menu'] ) ? $cols[2]['menu'] : pl_popular_taxonomy(); 
						
						echo pl_media_list( $title, $menu ); 
					?>
				</div>
				<div class="span3">
					<?php 
					
						$title = ( $cols[3]['title'] ) ? $cols[3]['title'] : __('Tags','pagelines'); 
						$menu = ( $cols[3]['menu'] ) ? $cols[3]['menu'] : pl_popular_taxonomy( 6, 'post_tag'); 
						
						echo pl_media_list( $title, $menu ); 
					?>
				</div>
				<div class="span3">
					<?php 
					
						$title = ( $cols[4]['title'] ) ? $cols[4]['title'] : __('Pages','pagelines'); 
						$menu = ( $cols[4]['menu'] ) ? $cols[4]['menu'] : pl_list_pages(); 
						
						echo pl_media_list( $title, $menu ); 
					?>
				</div>
		</div>

		<div class="whpfooter-bottom">
			<p>
				<?php echo $copy . ' ' . $tagline; ?>
			</p>
		</div>

	
	<?php
	}
	
	
	
}