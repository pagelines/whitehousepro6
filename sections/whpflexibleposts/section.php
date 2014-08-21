<?php
/*
	Section: WhiteHousePro Flexible Posts
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A robust posts section that's highly customizable and allows users to display the resulting posts virtually many ways imaginable.
	Class Name: WHPFlexiblePosts
	Filter: format
*/

class WHPFlexiblePosts extends PageLinesSection {


	var $default_limit = 3;

	function section_opts(){


		$options = array();

		$options[] = array(

			'title' => __( 'Config', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'			=> $this->id.'_whp_post_type',
					'type' 			=> 'select',
					'opts'			=> pl_get_thumb_post_types(),
					'default'		=> 4,
					'label' 	=> __( 'Select Post Type', 'pagelines' ),
					'help'		=> __( '<strong>Note</strong><br/> Post types for this section must have "featured images" enabled and be public.<br/><strong>Tip</strong><br/> Use a plugin to create custom post types for use.', 'pagelines' ),
				),
				array(
					'key'			=> $this->id.'_whp_sizes',
					'type' 			=> 'select_imagesizes',
					'label' 		=> __( 'Select Thumb Size', 'pagelines' ),
					'help'			=> __( 'For best results use large or full image sizes.', 'pagelines' )
				),

				array(
					'key'			=> $this->id.'_whp_total',
					'type' 			=> 'count_select',
					'count_start'	=> 5,
					'count_number'	=> 20,
					'default'		=> 10,
					'label' 		=> __( 'Total Posts Loaded', 'pagelines' ),
				),
				array(
					'key'			=> $this->id.'_whp_excerpt',
					'type' 			=> 'check',
					'default'		=> true,
					'label' 		=> __( 'Display Post Excerpt', 'pagelines' ),
				)


			)

		);

		$options[] = array(
			'key'		=> $this->id.'_whp_post_sort',
			'col'		=> 3,
			'type'		=> 'select',
			'label'		=> __( 'Sort elements by postdate', 'pagelines' ),
			'default'	=> 'DESC',
			'opts'			=> array(
				'DESC'		=> array('name' => __( 'Date Descending (default)', 'pagelines' ) ),
				'ASC'		=> array('name' => __( 'Date Ascending', 'pagelines' ) ),
				'rand'		=> array('name'	=> __( 'Random', 'pagelines' ) )
			)
		);

		$selection_opts = array(
			array(
				'key'			=> $this->id.'_whp_meta_key',
				'type' 			=> 'text',

				'label' 	=> __( 'Meta Key', 'pagelines' ),
				'help'		=> __( 'Select only posts which have a certain meta key and corresponding meta value. Useful for featured posts, or similar.', 'pagelines' ),
			),
			array(
				'key'			=> $this->id.'_whp_meta_value',
				'type' 			=> 'text',

				'label' 	=> __( 'Meta Key Value', 'pagelines' ),
			),
		);

			$selection_opts[] = array(
				'label'			=> 'Post Category',
				'key'			=> $this->id.'_whp_category',
				'type'			=> 'select_wp_tax',
				'post_type'		=> $this->opt($this->id.'_whp_post_type'),
				'help'		=> __( 'Only applies for standard blog posts.', 'pagelines' ),
			);



		$options[] = array(

			'title' => __( 'Additional Post Selection', 'pagelines' ),
			'type'	=> 'multi',
			'col'		=> 3,
			'opts'	=> $selection_opts
		);



		return $options;
	}

	function get_flexible_posts_image_size(){

		$x = rand(1, 12);

		$image_sizes = array(
			'basic-thumb',
			'landscape-thumb',
			'tall-thumb',
			'big-thumb'
		);

		if( $x == 1 ){
			return 'big-thumb';
		} elseif ( $x <= 3){
			return 'landscape-thumb';
		} elseif ( $x <= 5){
			return 'tall-thumb';
		} else
			return 'basic-thumb';

	}

	function section_template() {

		global $post;

		$show_excerpt = $this->opt( $this->id . '_whp_excerpt', array( 'default' => false ) );

		$post_type = $this->opt( $this->id.'_whp_post_type', array( 'default' => 'post' ) );

		$pt = get_post_type_object( $post_type );

		$total = $this->opt($this->id.'_whp_total', array( 'default' => 10 ) );

		$meta = $this->opt($this->id.'_whp_meta', array( 'default' => 'by [post_author] / <i class="icon icon-calendar"></i> [post_date] [post_edit]', 'shortcode' => false ) );


		if( $this->opt($this->id.'_whp_sizes') && $this->opt($this->id.'_whp_sizes') != '' )
			$sizes = $this->opt($this->id.'_whp_sizes');
		else
			$sizes = 'aspect-thumb';


		$sorting = $this->opt($this->id.'_whp_post_sort', array( 'default' => 'DESC' ) );

		$orderby = ( 'rand' == $sorting ) ? 'rand' : 'date';

		$the_query = array(
			'posts_per_page'   => $total,
			'post_type' 	   => $post_type,
			'orderby'          => $orderby,
			'order'            => $sorting,
		);

		if( $this->opt($this->id.'_whp_meta_key') && $this->opt($this->id.'_whp_meta_key') != '' && $this->opt($this->id.'_whp_meta_value') ){
			$the_query['meta_key'] = $this->opt($this->id.'_whp_meta_key');
			$the_query['meta_value'] = $this->opt($this->id.'_whp_meta_value');
		}


		$filter_tax = $this->opt($this->id.'_whp_category', array( 'default' => 'category' ) );

		$posts = get_posts( $the_query );

		$filters = array();
		foreach( $posts as $post ){
			$terms = wp_get_post_terms( $post->ID, $filter_tax );

			foreach( $terms as $t ){
				$filters[ $t->slug ] = $t->name;
			}
		}

		$args = array(
			'taxonomy' => $filter_tax
		); 
		

		if(!empty($posts)) { 
			?>
			
			<div class="whpflexibleposts-wrap">
				
				<ul class="whpflexibleposts row">

		<?php } 

		if(!empty($posts)):
			$item_cols = 6;
			$count = 0;
			$total = count($posts);
			 foreach( $posts as $post ):

				setup_postdata( $post );

				if( $count < 1 ){
	                $item_cols = 12;
	            }else{
	            	$item_cols = 6;
	            };

				echo pl_grid_tool('row_start', $item_cols, $count, $total);

				$permalink = get_permalink( $post->ID);

				?>


			<li class="span<?php echo $item_cols; ?>">

				<div class="whpfp-content">
					<div class="whpfp-image fix">
						<a href="<?php echo $permalink; ?>">
						<?php
						if ( has_post_thumbnail() )
							echo get_the_post_thumbnail( $post->ID, $sizes	, array('title' => ''));
						else
							printf('<img src="%s" alt="no image added yet." />', pl_default_image() );

							?>
						</a>
					</div><!--work-item-->

					<div class="whpfp-content fix">
						<h3>
							<a href="<?php echo $permalink; ?>">
							<?php the_title(); ?>
							</a>
						</h3>
						<div class="whpfp-meta">
							<?php echo do_shortcode( $meta ); ?>
						</div>
					
						<?php if( $show_excerpt ): ?>
						<div class="whpfp-excerpt">
							<?php the_excerpt();?>
							<a href="<?php echo $permalink; ?>" class="read-more">Continue Reading...</a>
						</div>
						<?php endif;?>
					</div>
				</div>
	            
				
			</li>

			<?php

			echo pl_grid_tool('row_end', $item_cols, $count, $total);

			$count++;

			endforeach; endif;


			if(!empty($posts))
		 		echo '</ul></div>';

			wp_reset_query();

	}

}