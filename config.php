<?php


class PageLinesInstallTheme extends PageLinesInstall{


	/*
	 * This sets up the default configuration for differing page types
	 * This filter will be used when no 'map' is set on a specific page. 
	 */ 
	function default_template_handling( $t ){
	

		// 404 Page
		if( is_404() ){

				$content = array(
					array(
						'object'	=> 'PageLinesNoPosts',
						'span' 		=> 10,
						'offset'	=> 1
					)
				);

		} 

		// Overall Default 
		else {
			$content = array(
				array(
					'object'	=> 'PageLinesPostLoop',
				)
			);
			
		}


		$t = array( 'content' => $content );
	
		return $t;
		
	}
	
	
	
	/* 
	 * This sets the global areas of the site's sections on theme activation. 
	 */ 
	function global_region_map(){
		
		$map = array(
			'fixed'	=> array(), 
			'footer'	=> array(
				array(
					'content'	=> array(
						array( 'object'	=> 'WHPFooter' ),
					)
				)
			),
			'header'	=> array(
				array(
					'settings'	=> array(
						'pl_area_pad' 		=> '0px',
					),
					'content'	=> array(
						array( 
							'object'	=> 'WHPHeader',
						),
					)
				)
			)
		);
		
		return $map;
		
	}

	/* 
	 * This sets the global option values on theme activation. 
	 */
	function set_global_options(){
		
		$options_array = array(
			'supersize_bg'					=> 0,
			'content_width_px'				=> '1100px',
			'linkcolor'						=> '#B9191E',
			'text_primary'					=> '#414141',
			'bodybg'						=> '#F9F9F9',
			'layout_mode'					=> 'pixel',
			'layout_display_mode'			=> 'display-full',
			'font_primary'					=> 'georgia',
			'base_font_size'				=> 14,
			'font_primary_weight'			=> 400,
			'font_headers'					=> 'georgia',
			'header_base_size'				=> 16,
			'font_headers_weight'			=> 300,
			'region_disable_fixed'			=> 1
		);
		
		return $options_array;
		
	}
	
	
	/*
	 * 
	 */ 
	function map_templates_to_pages( ){
		
		$map = array(
			//'is_404'	=> 'whp-archive',
			'tag'		=> 'whp-archive',
			'search'	=> 'whp-archive',
			'category'	=> 'whp-archive',
			'author'	=> 'whp-archive',
			'archive'	=> 'whp-archive',
			'blog'		=> 'whp-blog',
			'post'		=> 'whp-post',
		);
		
		return $map;
		
		
	}
	
	
	/* 
	 * This adds or updates templates defined by a map on theme activation
	 * Note that the user is redirected to 'welcome' template on activation by default (unless otherwise specified)
	 */
	function page_templates(){
		
		$templates = array(
			'whp-welcome' 	=> $this->template_welcome(), // default on install
			'whp-blog' 		=> $this->template_blog(),
			'whp-post' 		=> $this->template_post(),
			'whp-archive'	=> $this->template_archive()
		);
				
		return $templates;
		
	}

	// Template Map
	function template_welcome(){
		
		$template['key'] = 'whp-welcome';
		
		$template['name'] = 'WhiteHousePro | Welcome';
		
		$template['desc'] = 'Getting started guide &amp; template.';
		
		$template['map'] = array(
			
			array(
				'object'	=> 'PLSectionArea',
				'settings'	=> array(
					'pl_area_pad' 		=> '0px',
				),
				
				
				'content'	=> array(
					array(
						'object'	=> 'WHPSlider',
						'settings'	=> array(
							'whpslider_array'	=> array(
								array(
									'image'         => 'http://themes.pagelines.com/whitehousepro/wp-content/uploads/sites/7/2014/08/slide1.jpg',
				                    'button_color'  => 'whp-red',
				                    'location'		=> 'slide-left',
				                    'title'         => 'Welcome to WhiteHousePro',
				                    'text'          => 'A sophisticated theme for Wordpress that makes a bold impression. Powered by PageLines DMS with drag-and-drop.',
				                    'link'          => 'http://www.pagelines.com/',
				                    'link_text'     => 'Visit PageLines.com',
								),
							)
						)
					),
				)
			),
			array(
				'content'	=> array(
					array(
						'object'	=> 'pliBox',
						'settings'	=> array(
							'ibox_array'	=> array(
								array(
									'title'	=> 'User Guide',
									'text'	=> 'New to PageLines? Get started fast with PageLines DMS Quick Start guide...',
									'icon'	=> 'rocket',
									'link'	=> 'http://www.pagelines.com/user-guide/'
								),
								array(
									'title'	=> 'Forum',
									'text'	=> 'Have questions? We are happy to help, just search or post on PageLines Forum.',
									'icon'	=> 'comment',
									'link'	=> 'http://forum.pagelines.com/'
								),
								array(
									'title'	=> 'Docs',
									'text'	=> 'Time to dig in. Check out the Docs for specifics on creating your dream website.',
									'icon'	=> 'file-text',
									'link'	=> 'http://docs.pagelines.com/'
								),
							)
						)
					),
				)
			)
		); 
		
		return $template;
	}

	
	// Template Map
	function template_archive(){
		
		$template['key'] = 'whp-archive';
		
		$template['name'] = 'WhiteHousePro | Archive Page';
		
		$template['desc'] = 'Template for archives and other listings.';
		
		$template['map'] = array(
			array(
				'object'	=> 'PLSectionArea',
				'settings'	=> array(
					'pl_area_pad' 		=> '0px',
				),

				'content'	=> array(
					array(
						'object'	=> 'PageLinesHighlight',
						'settings'	=> array(
							'_highlight_head'	=> 'Archive',
						),
					),
					array(
						'object'	=> 'WHPBlog',
					),
				)
			),
		); 
		
		return $template;
	}
	
	// Template Map
	function template_blog(){
		
		$template['key'] = 'whp-blog';
		
		$template['name'] = 'WhiteHousePro | Blog Page';
		
		$template['desc'] = 'Used on blog pages.';
		
		$template['map'] = array(
			array(
				'object'	=> 'PLSectionArea',
				'settings'	=> array(
					'pl_area_pad' 		=> '0px',
				),

				'content'	=> array(
					array(
						'object'	=> 'PageLinesHighlight',
						'settings'	=> array(
							'_highlight_head'	=> 'Blog',
							'_highlight_subhead' => 'Latest news from WhiteHousePro',
						),
					),
					array(
						'object'	=> 'WHPBlog',
					),
					array(
						'object'	=> 'PageLinesPagination',
					),
				)
			),
		); 
		
		return $template;
	}
	
	// Template Map
	function template_post(){
		
		$template['key'] = 'whp-post';
		
		$template['name'] = 'WhiteHousePro | Single Post';
		
		$template['desc'] = 'Used on single post pages.';
		
		$template['map'] = array(
			array(
				'object'	=> 'PLSectionArea',
				'settings'	=> array(
					'pl_area_pad' 		=> '0px',
				),

				'content'	=> array(
					array(
						'object'	=> 'WHPBlog',
					),
					array(
						'object'	=> 'PageLinesComments',
						'span'		=> 8,
					),
				)
			),
		); 
		
		return $template;
	}
	
	
	function page_on_activation( $templateID = 'welcome' ){
		
		global $user_ID;
		
		$data = $this->activation_page_data();
		
		$page = array(
			'post_type'		=> 'page',
			'post_status'	=> 'draft',
			'post_author'	=> $user_ID,
			'post_title'	=> __( 'PageLines WhiteHousePro Getting Started', 'pagelines' ),
			'post_content'	=> $this->getting_started_content(),
			'post_name'		=> 'pl-getting-started',
			'template'		=> 'whp-welcome',
		);
		
		$post_data = wp_parse_args( $data, $page );
		
		// Check or add page (leave in draft mode)
		$pages = get_pages( array( 'post_status' => 'draft' ) );
		$page_exists = false;
		foreach ($pages as $page) { 
			
			$name = $page->post_name;
			
			if ( $name == $post_data['post_name'] ) { 
				$page_exists = true;
				$id = $page->ID;
			}
			 
		}
		
		if( ! $page_exists )
			$id = wp_insert_post(  $post_data );
			
		
		pl_set_page_template( $id, $post_data['template'], 'both' );
		
		return $id;
	}

}
