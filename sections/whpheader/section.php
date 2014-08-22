<?php
/*
	Section: WhiteHousePro Header
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A stylized header with logo, search bar and navigation.
	Class Name: WHPHeader
	Filter: nav,
*/


class WHPHeader extends PageLinesSection {

	function section_persistent(){
		register_nav_menus( array( 'whpheader_nav' => __( 'WhiteHousePro Header Section', 'pagelines' ) ) );

	}

	function section_opts(){


		$opts = array(
			array(
				'type'	=> 'multi',
				'key'	=> 'whpheader_content',
				'title'	=> __( 'Logo', 'pagelines' ),
				'col'	=> 1,
				'opts'	=> array(
					array(
						'type'	=> 'image_upload',
						'key'	=> 'whpheader_logo',
						'label'	=> __( 'WhiteHousePro Header Logo', 'pagelines' ),
						'has_alt'	=> true,
						'opts'	=> array(
							'center_logo'	=> 'Center: Logo | Right: Pop Menu | Left: Site Search',
							'left_logo'		=> 'Left: Logo | Right: Standard Menu',
						),
					),
					array(
						'type'		=> 'check',
						'key'		=> 'whpheader_logo_disable',
						'label'		=> __( 'Hide Logo?', 'pagelines' ),
						'default'	=> false
					)
				)

			),

			array(
				'type'	=> 'multi',
				'key'	=> 'whpheader_social',
				'title'	=> __( 'Search Bar', 'pagelines' ),
				'col'	=> 1,
				'opts'	=> array(
					array(
						'key'	=> 'whpheader_search',
						'type'	=> 'check',
						'label'	=> __( 'Hide Search?', 'pagelines' ),
					),
				)

			),


			array(
				'type'	=> 'multi',
				'key'	=> 'whpheader_nav',
				'title'	=> 'Navigation',
				'col'	=> 2,
				'opts'	=> array(
					array(
						'key'	=> 'whpheader_nav_help',
						'type'	=> 'help_important',
						'label'	=> __( 'Using styled submenus (multi column drop downs)', 'pagelines' ),
						'help'	=> __( 'Want multi column "mega menu" or "Panel Menu"? Simply add a class of "megamenu" or "panelmenu" to the list items using the WP menu creation tool.<br /> Add a <span> tag to make text italic on menu items', 'pagelines' )
					),
					array(
						'key'	=> 'whpheader_menu',
						'type'	=> 'select_menu',
						'label'	=> __( 'Select Menu', 'pagelines' ),
					),
				)
			)
		);

		return $opts;

	}

	function section_styles(){

		wp_enqueue_script( 'whpheader-custom', $this->base_url.'/whp.header.js',  array( 'jquery' ), pl_get_cache_key(), true );	
	
	}

	
   function section_template( $location = false ) {

   		$logo = $this->image( 'whpheader_logo', pl_get_theme_logo(), array(), get_bloginfo('name'));

   		$hide_logo = ( $this->opt('whpheader_logo_disable') ) ? $this->opt('whpheader_logo_disable') : false;

   		$hide_search = ( $this->opt('whpheader_search') ) ? true : false;

   		$search = sprintf('%s', pagelines_search_form( false, 'whpheader-searchform') ); 

		$menu = ( $this->opt('whpheader_menu') ) ? $this->opt('whpheader_menu') : false;

	?>

	<div class="row fix">

		<div class="span4 logo">

			<?php if( '1' !== $hide_logo ): ?>

				<a href="<?php echo home_url('/');?>"><?php echo $logo; ?></a>
			
			<?php endif; ?>

		</div>

		<div class="span6 offset2">
			
			<?php if( ! $hide_search ) echo $search; ?>

		</div>
	</div>

	<div class="nav-wrap">
		
			<?php 

			$menu_args = array(
				'theme_location' => 'whpheader_nav',
				'menu' => $menu,
				'menu_class'	=> 'inline-list pl-nav sf-menu',
				
			);

			echo pl_navigation( $menu_args ); 

			?>
	
	</div>
<?php }

}