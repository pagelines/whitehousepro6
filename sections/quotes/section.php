<?php
/*
	Section: Quotes
	Author: PageLines
	Author URI: http://pagelines.com
	Description: Full width quotes section
	Class Name: PLQuotes
	Edition: Pro
*/

class PLQuotes extends PageLinesSection {

	var $default_limit = 2;

	function section_styles(){
		wp_enqueue_script('royalslider', $this->base_url.'/royalslider/jquery.royalslider.min.js', array('jquery'));
		wp_enqueue_style( 'royalslider-css', $this->base_url.'/royalslider/royalslider.css');
		wp_enqueue_style( 'royalslider-theme', $this->base_url.'/royalslider/skins/default/rs-default.css');
		
	}
	
	function section_head(){
		?>

		<style>
		
		<?php echo $this->prefix(); ?> #quotes,
		<?php echo $this->prefix(); ?> .quote-container,
		<?php echo $this->prefix(); ?> .rsNav{
			background: <?php echo pl_hashify($this->opt('quotes_background_color')); ?>;
		}
			
		</style>
		
		 <script>
		      jQuery(document).ready(function(jQuery) {
		 		jQuery('<?php echo $this->prefix();?> .quotes').royalSlider({
			
					autoScaleSlider: true,
					autoScaleSliderHeight: '150',
					autoHeight: true,
					arrowsNav: true,
					fadeinLoadedSlide: true,
					controlNavigation: 'bullets',
					loop: true,
					loopRewind: true,
	
					keyboardNavEnabled: true,
					slidesSpacing: 0,
					
					})
		})

		    </script>
		
		<?php
	}

	function section_opts(){
		$options = array();

		$options[] = array(

			'title' => __( 'Quotes Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'			=> 'quotes_count',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 20,
					'default'		=> 3,
					'label' 	=> __( 'Number of Quotes to Configure', 'pagelines' ),
				),
				array(
					'key'			=> 'quotes_background_color',
					'type' 			=> 'color',
					'label' 		=> __( 'Background Color', 'pagelines' ),
					'default' 		=> 'ffffff',
				),
			)

		);

		
		//NEW
		$options[] = array(
			'key'		=> 'revslider_array',
	    	'type'		=> 'accordion', 
			'col'		=> 2,
			'title'		=> __('Quotes Setup', 'pagelines'), 
			'post_type'	=> __('Quote', 'pagelines'), 
			'opts'	=> array(
				array(
					'key'	=> 'quote',
					'label'	=> __( 'Quote', 'pagelines' ),
					'type'	=> 'text'
				),
				array(
					'key'	=> 'quote_author',
					'label'	=> __( 'Quote Author', 'pagelines' ),
					'type'	=> 'text'
				),
				array(
					'key'	=> 'quote_author_link',
					'label'	=> __( 'Quote Author Link', 'pagelines' ),
					'type'	=> 'text'
				),
			)
	    );
		

	/*	$slides = ($this->opt('quotes_count')) ? $this->opt('quotes_count') : $this->default_limit;
	
		for($i = 1; $i <= $slides; $i++){

			$opts = array();
			
			$opts[] = array(
				'key'		=> 'quote_'.$i,
				'label'		=> __( 'Quote', 'pagelines' ),
				'type'		=> 'textarea',
			);

			$opts[] = array(
				'key'		=> 'quote_author_'.$i,
				'label'	=> __( 'Quote Author', 'pagelines' ),
				'type'	=> 'text',
			);
			
			$opts[] = array(
				'key'		=> 'quote_author_link_'.$i,
				'label'	=> __( 'Quote Author Link', 'pagelines' ),
				'type'	=> 'text',
			);

		} */

		return $options;
		
	}
	

	function the_quotes(){
		
		$num = ($this->opt('quotes_count')) ? $this->opt('quotes_count') : $this->default_limit;
		$out = array();
		
		for($i = 1; $i <= $num; $i++):
			
			$quote = ($this->opt('quote_'.$i)) ? $this->opt('quote_'.$i) : ''; 
			$quoteauthor = ($this->opt('quote_author_'.$i)) ? $this->opt('quote_author_'.$i) : '';
			$quoteauthorlink = ($this->opt('quote_author_link_'.$i)) ? $this->opt('quote_author_link_'.$i) : '';
			
			if($quoteauthor != '' || $quote != ''){
				$out[] = array(
					'quote'	=> $quote, 
					'quoteauthorlink'	=> $quoteauthorlink, 
					'quoteauthor'	=> $quoteauthor
				);
			}
			 
			
		endfor;
		
		if( empty($out) ){
			$out[] = array(
				'quote'	=> 'You can’t connect the dots looking forward; <br />you can only connect them looking backwards',
				'quoteauthorlink'	=> 'http://www.pagelines.com', 
				'quoteauthor'	=>	'Steve Jobs'
			);
			
			$out[] = array(
				'quote'	=> 'Add up to twenty testimonials to this section here. <br /> Select your own background color too!', 
				'quoteauthorlink'	=> 'http://www.pagelines.com', 
				'quoteauthor'	=>	'PageLines'
			);
			
			$out[] = array(
				'quote'	=> 'iBlog is the most flexible WordPress Theme <br />that we\'ve built as of yet. Yes it\'s that good!', 
				'quoteauthorlink'	=> 'http://www.pagelines.com', 
				'quoteauthor'	=>	'PageLines'
			);
		}
		
		return $out;
	}

   function section_template( ) {
	
		
	 ?>
	

		<div id="quotes" class="quotes royalSlider videoGallery rsDefault">
			<?php foreach($this->the_quotes() as $m): ?>

				<div class="quote-container">
					<div class="quote rsContent">
						<a href="<?php echo $m['quoteauthorlink'];?>"><?php echo $m['quoteauthor'];?></a>
						<div class="quote-content"><span class="left-quote">&ldquo;</span> <h5><?php echo $m['quote'];?></h5><span class="right-quote">&rdquo;</span></div>
					</div>
				</div>
				
			<?php endforeach; ?>
		
		</div>

<?php }


}