<?php
/*
	Section: WhiteHousePro Footer
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description:
	Class Name: WHPFooter
*/

class WHPFooter extends PageLinesSection {

	
	function section_opts(){

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
				'type' 			=> 'multi',
				'title' 		=> __( 'Breadcrumbs', 'pagelines' ),
				'opts'			=> array(			
					array(
						'key'		=> 'breadcrumbs_icon',
						'label'		=> __( 'Breadcrumbs Icon', 'pagelines' ),
						'type'		=> 'select_icon',
						'default' 	=> 'pagelines'
					),
					array(
						'type'		=> 'check',
						'key'		=> 'footer_top_disable',
						'label'		=> __( 'Hide Breadcrumbs & Navigation areas?', 'pagelines' ),
						'default'	=> false
					),
				)

			),

			array(
				'type' 			=> 'multi',
				'title' 		=> __( 'Navigation Columns', 'pagelines' ),
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
	
	
   function section_template() { 

		$breadcrumbs_icon = ( $this->opt('breadcrumbs_icon') ) ? $this->opt('breadcrumbs_icon') : 'pagelines';

		$hide_footer_top = ( $this->opt('footer_top_disable') ) ? $this->opt('footer_top_disable') : false;
		
		$tagline = ( $this->opt('tagline') ) ? $this->opt('tagline') : 'Designed by PageLines in California.';
		
		$copy = ( $this->opt('copy') ) ? $this->opt('copy') : 'Copyright &copy; 2014 iBlogPro All rights reserved.';
		
		
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
	

		<?php if( '1' !== $hide_footer_top ): ?>

				<div class="row fix pl-shadow-wrap">
					<div class="span4">
						<?php 
						
							$title = ( $cols[1]['title'] ) ? $cols[1]['title'] : __('Pages','pagelines'); 
							$menu = ( $cols[1]['menu'] ) ? $cols[1]['menu'] : pl_list_pages(); 
							
							echo pl_media_list( $title, $menu ); 
						?>
						
					</div>
					<div class="span4">
						<?php 
						
							$title = ( $cols[2]['title'] ) ? $cols[2]['title'] : __('Categories','pagelines'); 
							$menu = ( $cols[2]['menu'] ) ? $cols[2]['menu'] : pl_popular_taxonomy(); 
							
							echo pl_media_list( $title, $menu ); 
						?>
					</div>
					<div class="span4">
						<?php 
						
							$title = ( $cols[3]['title'] ) ? $cols[3]['title'] : __('Tags','pagelines'); 
							$menu = ( $cols[3]['menu'] ) ? $cols[3]['menu'] : pl_popular_taxonomy( 6, 'post_tag'); 
							
							echo pl_media_list( $title, $menu ); 
						?>
					</div>
			</div>

		<?php endif; ?>

		<div class="whpfooter-bottom">
			<p>
				<?php echo $copy . ' ' . $tagline; ?>
			</p>
		</div>

	
	<?php
	}
	
	
	
}