<?php
/*
	Section: WhiteHousePro Blog
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A WhiteHousePro themed blog.
	Class Name: WHPBlog
	Filter: format
*/


class WHPBlog extends PageLinesSection {

	
	function before_section_template( $location = '' ) {

		global $wp_query;

		if(isset($wp_query) && is_object($wp_query))
			$this->wrapper_classes[] = ( $wp_query->post_count > 1 ) ? 'multi-post' : 'single-post';

	}

	function section_opts(){
		
		$options = array();

		$options[] = array(

			'title' => __( 'Configuration', 'pagelines' ),
			'key'	=> 'whpblog_config',
			'col'	=> 1,
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'			=> 'hide_author',
					'type' 			=> 'check',
					'label' 	=> __( 'Hide Author?', 'pagelines' ),
				),
				array(
					'key'			=> 'hide_date',
					'type' 			=> 'check',
					'label' 	=> __( 'Hide Date?', 'pagelines' ),
				),
				array(
					'key'			=> 'hide_categories',
					'type' 			=> 'check',
					'label' 	=> __( 'Hide Categories?', 'pagelines' ),
				),
				array(
					'key'			=> 'hide_comment_link',
					'type' 			=> 'check',
					'label' 	=> __( 'Hide Comment Counter/Link?', 'pagelines' ),
				),
			),

		);

		return $options;
		
	}

	/**
	* Section template.
	*/
   function section_template() {
	
		if( have_posts() )
			while ( have_posts() ) : the_post();  $this->get_article(); endwhile;
		else
			$this->posts_404();
	
	}
	
	function get_article(){
		$format = get_post_format();

		$linkbox = ($format == 'quote' || $format == 'link') ? true : false;

		$hide_author = ( $this->opt('hide_author') ) ? $this->opt('hide_author') : false;

		$hide_date = ( $this->opt('hide_date') ) ? $this->opt('hide_date') : false;

		$hide_categories = ( $this->opt('hide_categories') ) ? $this->opt('hide_categories') : false;
		
		$gallery_format = get_post_meta( get_the_ID(), '_pagelines_gallery_slider', true);

		$class[ ] = ( ! empty( $gallery_format ) ) ? 'use-flex-gallery' : '';
		
		$classes = apply_filters( 'pagelines_get_article_post_classes', join( " ", $class) );
		
		?>
		<div class="row fix">
			<div class="span12">
				
				<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
					<header class="post-header">
						<?php if( ! $linkbox  ): ?>
							<h2 class="title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
						<?php endif; ?>
					</header>

					<ul class="post-meta">
						
						<?php if( ! $hide_author  ): ?>
							<li class="author-name">by <?php echo get_the_author(); ?></li>
						<?php endif; ?>

						<?php if( ! $hide_date  ): ?>
							<li class="post-date">
								<i class="icon icon-calendar"></i> <?php echo do_shortcode( '[post_date]' ); ?>
							</li>
						<?php endif; ?>

						<?php if( ! $hide_categories  ): ?>
							<li class="post-categories">
								<i class="icon icon-th-list"></i> <?php echo do_shortcode( '[post_categories]' ); ?>
							</li>
						<?php endif; ?>

						<?php if( comments_open( get_the_ID() ) && ! $this->opt('hide_comment_link') ): ?>
							<li class="post-comments">
								<a href="<?php the_permalink(); ?>#comments">
									<i class="icon icon-comments"></i> <?php comments_number( '0', '1', '%s' ); ?>
								</a>
							</li>
						<?php endif; ?>
					</ul>

					<?php
						$media = pagelines_media( array( 'thumb-size' => 'aspect-thumb' ) ); 
						
						if( ! empty( $media ) )
							printf( '<div class="metamedia">%s</div>', $media );
					
					?>

				
					<?php if( ! $linkbox || is_single() ): ?>
						<div class="content">
							<?php 
								if( ! is_single() ) 
									echo get_the_excerpt();
								else{
									the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pagelines' ) );

									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pagelines' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
									) );
								}
									
							?>
							
						</div>
					<?php endif; ?>
					<div class="the-footer fix">
							<?php  if( ! is_single() ): ?>
								<a href="<?php the_permalink(); ?>" class="read-more">Continue Reading...</a>
							<?php else: ?>
								<?php previous_post_link('%link', 'Next article: %title') ?>
							<?php endif; ?>						
					</div>
				</article>
			</div>
		</div>
		<?php 
	}
	
	function posts_404(){
		echo '<h2>404</h2>';
	}
	
}