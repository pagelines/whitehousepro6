<?php
/*
	Section: StarBars
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: Awesome animated stat bars that animate as the user scrolls. Use them to show stats or other information.
	Class Name: PageLinesStarBars
	Cloning: true
	Edition: pro
	Filter: post-format
*/

class PageLinesStarBars extends PageLinesSection {

	var $default_limit = 3;

	function section_styles(){

		wp_enqueue_script( 'starbar', $this->base_url.'/starbar.js', array( 'pagelines-viewport', 'pagelines-easing' ), PL_CORE_VERSION, true ); 

	}

	function section_head() {
    ?>
        <style type="text/css">

			<?php echo $this->prefix(); ?> .starbars li span{
				background-color: <?php echo pl_hashify($this->opt('starbar_fill')); ?>;
			}
			<?php echo $this->prefix(); ?> .starbars li .bar-wrap{
				background-color: <?php echo pl_hashify($this->opt('starbar_background')); ?>;
			}
			
			<?php echo $this->prefix(); ?> .starbars li strong{
				color: <?php echo pl_hashify($this->opt('starbar_text_color')); ?>;
			}
			
        </style>
    <?php
    }

	function section_opts(){

		$options = array();

		$options[] = array(

			'title' => __( 'StarBar Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'			=> 'starbar_count',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> 4,
					'label' 	=> __( 'Number of StarBars to Configure', 'pagelines' ),
				),
				array(
					'key'			=> 'starbar_total',
					'type' 			=> 'text',
					'default'		=> 100,
					'label' 		=> __( 'Starbar Total Count (Number)', 'pagelines' ),
					'help' 			=> __( 'This number will be used to calculate the percent of the bar filled. The StarBar values will be shown as a percentage of this value. Default is 100.', 'pagelines' ),
				),

				array(
					'key'			=> 'starbar_modifier',
					'type' 			=> 'text',
					'default'		=> '%',
					'label' 		=> __( 'Starbar Modifier (Text Added to Stats)', 'pagelines' ),
					'help' 			=> __( 'This will be added to the stat number.', 'pagelines' ),
				),
				array(
					'key'			=> 'starbar_format',
					'type' 			=> 'select',
					'opts'		=> array(
						'append'		=> array( 'name' => 'Append Modifier (Default)' ),
						'prepend'	 	=> array( 'name' => 'Prepend Modifier' ),
					),
					'default'		=> 'append',
					'label' 	=> __( 'Starbar Format', 'pagelines' ),
				),
				array(
					'key'			=> 'starbar_container_title',
					'type' 			=> 'text',
					'default'		=> 'StarBar',
					'label' 	=> __( 'StarBar Title (Optional)', 'pagelines' ),
				),
				array(
					'key'			=> 'starbar_container_subtitle',
					'type' 			=> 'text',
					'default'		=> 'Optional Subtitle',
					'label' 	=> __( 'StarBar Subtitle (Optional)', 'pagelines' ),
				),
				array(
                    'key' => 'starbar_fill',
                    'type' => 'color',
                    'label' => __('Bars Fill Color', 'pagelines'),
                    'default' => '59b1f6'
                ),
				array(
                    'key' => 'starbar_background',
                    'type' => 'color',
                    'label' => __('Bars Background Color', 'pagelines'),
                    'default' => 'f9f9f9'
                ),
				array(
                    'key' => 'starbar_text_color',
                    'type' => 'color',
                    'label' => __('Bars Text Color', 'pagelines'),
                    'default' => 'ffffff'
                ),
			)

		);

		$slides = ($this->opt('starbar_count')) ? $this->opt('starbar_count') : $this->default_limit;

		for($i = 1; $i <= $slides; $i++){

			$opts = array(
				
				'starbar_descriptor_'.$i 	=> array(
					'label'		=> __( 'Descriptor', 'pagelines' ),
					'type'		=> 'text'
				),
				'starbar_value_'.$i 	=> array(
					'label'	=> __( 'Value', 'pagelines' ),
					'type'	=> 'text',
					'help'	=> __( 'Shown as a percentage of the StarBar total in the config.', 'pagelines' ),
				),
			);


			$options[] = array(
				'col'		=> 2,
				'title' 	=> __( '<i class="icon-star"></i> StarBar #', 'pagelines' ) . $i,
				'type' 		=> 'multi',
				'opts' 		=> $opts,

			);

		}

		return $options;
	}

	function section_template(  ) {

		$starbar_title = $this->opt('starbar_container_title');
		$starbar_subtitle = $this->opt('starbar_container_subtitle');
		$starbar_mod = $this->opt('starbar_modifier');
		$starbar_total = (int) $this->opt('starbar_total');
		$starbar_count = $this->opt('starbar_count');
		$starbar_format = $this->opt('starbar_format');

		$starbar_title = ($starbar_title) ? sprintf('<h3>%s</h3>', $starbar_title) : '';
		$starbar_subtitle = ($starbar_subtitle) ? sprintf('<p>%s</p>', $starbar_subtitle) : '';

		$format = ($starbar_format) ? $starbar_format : 'append';

		$mod = ($starbar_mod) ? $starbar_mod : '%';
		
		$total = ($starbar_total) ? $starbar_total : 100;
		
		$total = apply_filters('starbars_total', $total);
		
		$output = '';
		for($i = 1; $i <= $starbar_count; $i++){

			$descriptor = $this->opt('starbar_descriptor_'.$i);
			$value = (int) $this->opt('starbar_value_'.$i);
			
			$value = apply_filters('starbar_value', $value, $i, $descriptor, $this); 
			

			$desc = ($descriptor) ? sprintf('<p>%s</p>', $descriptor) : '';

			if(!$value)
				continue;

			if(is_int($value) && is_int($total))
				$width = floor( $value / $total * 100 ) ;
			else
				$width = 0;

			$value = ($width > 100) ? $total : $value;
			$width = ($width > 100) ? 100 : $width;


			$tag = ( $format == 'append' ) ? $value . $mod : $mod . $value;

			$total_tag = ( $format == 'append' ) ? $starbar_total . $mod : $mod . $starbar_total;

		//	$draw_total_tag = ($i == 1) ? sprintf('<strong>%s</strong>', $total_tag) : '';

			$output .= sprintf(
				'<li>%s<div class="bar-wrap"><span class="the-bar" data-width="%s"><strong>%s</strong></span></div></li>',
				$desc,
				$width.'%',
				$tag
			);
		}


		if($output == ''){
			$this->do_defaults();
		} else
			printf('<div class="starbars-wrap">%s %s<ul class="starbars">%s</ul></div>', $starbar_title, $starbar_subtitle, $output);



	}

	function do_defaults(){

		?>
		<div class="starbars-wrap">
			<h2>StarBar</h2>
			<p>Optional Subtitle</p>
			<ul class="starbars">
				
				<li>
					<p>Ninja Ability</p>
					<div class="bar-wrap">
						<span class="the-bar" data-width="70%"><strong>70%</strong></span>
					</div>
				</li>
				<li>
					<p>Tree Climbing Skills</p>
					<div class="bar-wrap">
						<span class="the-bar" data-width="90%"><strong>90%</strong></span>
					</div>
				</li>
			</ul>
		</div>
		<?php
	}
}