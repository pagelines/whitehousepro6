<?php
/*
	Section: Gallery
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: An advanced, touch and swipe enabled image and rich media Gallery.
	Class Name: PLGallery
	Edition: pro
	Filter: slider, gallery
*/


class PLGallery extends PageLinesSection {

	var $default_limit = 3;

	function section_opts(){

		$options = array();

		$options[] = array(
			'title' => __( 'Slider Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'key'		=> 'revslider_config',
			'post_type'	=> __('Slide', 'pagelines'), 
			'opts'	=> array(
					array(
						'key'			=> 'revslider_delay',
						'type' 			=> 'text',
						'default'		=> 9000,
						'label' 	=> __( 'Time Per Slide (in Milliseconds)', 'pagelines' ),
					),
				)
			);

		$options[] = array(
			'key'		=> 'revslider_array',
	    	'type'		=> 'accordion', 
			'col'		=> 2,
			'title'		=> __('Slides Setup', 'pagelines'), 
			'post_type'	=> __('Gallery', 'pagelines'), 
			'opts'	=> array(
				array(
					'key'		=> 'background',
					'label' 	=> __( 'Gallery Image', 'pagelines' ),
					'type'		=> 'image_upload',
					'sizelimit'	=> 2097152, // 2M
					'help'		=> __( 'For high resolution, 2000px wide x 800px tall images. (2MB Limit)', 'pagelines' )
				),

			)
	    );


		return $options;
	}

	function section_styles(){

		wp_enqueue_script( 'revslider-plugins', $this->base_url.'/jquery.revslider.plugins.min.js', array( 'jquery' ), PL_CORE_VERSION, true );
		wp_enqueue_script( 'revslider', $this->base_url.'/jquery.revslider.min.js', array( 'jquery' ), PL_CORE_VERSION, true );


	}

	function section_head( ){

		?>		

		<script>
				jQuery(document).ready(function() {

					jQuery('<?php echo $this->prefix();?> .revslider-full').show().revolution(
						{
							delay:<?php echo $this->opt('revslider_delay', array('default' => 9000));?>,
							startwidth:940,
							startheight:480,
							onHoverStop:"on",
							thumbWidth: 100,
							thumbHeight: 50,
							thumbAmount: 3,
							hideThumbs: 200,
							navigationType:"thumbnails",
							navigationArrows:"solo",
							navigationStyle:"round",
							navigationHAlign:"center",
							navigationVAlign:"bottom",
							navigationHOffset:0,
							navigationVOffset:20,
							soloArrowLeftHalign:"left",
							soloArrowLeftValign:"center",
							soloArrowLeftHOffset:20,
							soloArrowLeftVOffset:0,
							soloArrowRightHalign:"right",
							soloArrowRightValign:"center",
							soloArrowRightHOffset:20,
							soloArrowRightVOffset:0,
							touchenabled:"on",
							stopAtSlide:-1,
							stopAfterLoops:-1,
							hideCaptionAtLimit:0,
							hideAllCaptionAtLilmit:0,
							hideSliderAtLimit:0,
							fullWidth:"on",
							shadow:0

						}

						);

				});

		</script>
	<?php }

	function render_slides(){
	
		$slide_array = $this->opt('revslider_array');		
	
		$output = '';
		
		if( is_array($slide_array) ){
			
			
			foreach( $slide_array as $slide ){
				
				$the_bg = pl_array_get( 'background', $slide ); 

				if( $the_bg){
					
					$the_text = pl_array_get( 'text', $slide );
					
					$the_subtext = pl_array_get( 'subtext', $slide ); 
					
					$the_link = pl_array_get( 'link', $slide ); 

					$the_location = pl_array_get( 'location', $slide ); 

					$transition = pl_array_get( 'transition', $slide, 'fade' ); 
					
					if($the_location == 'centered'){
						$the_x = 'center';
						$caption_class = 'centered sfb stb';
					} elseif ($the_location == 'right-side'){
						$the_x = '560';
						$caption_class = 'right-side sfr str';
					} else {
						$the_x =  '0';
						$caption_class = 'left-side sfl stl';
					}

					$bg = ($the_bg) ? sprintf('<img src="%s" data-fullwidthcentering="on">', $the_bg) : '';

					$link = ($the_link) ? sprintf('<a href="%s" class="slider-btn">%s <i class="icon-angle-right"></i></a>', $the_link, __('Read More', 'pagelines')) : '';


					$output .= sprintf('<li data-slotamount="7">%s</li>', $bg);
				}
				
			
			}
		
		}
				
		
		return $output;
	}

	function default_slides(){
		?>

			<li data-transition="fade" data-slotamount="10">
				<img src="<?php echo $this->base_url;?>/images/bg1.jpg" data-fullwidthcentering="on">
				<div class="caption slider-content right-side sfr str"
					 data-x="560"
					 data-y="130"
					 data-speed="300"
					 data-start="500"
					 data-easing="easeOutExpo"  >

						<h2><span class="slider-text">
						Welcome to iBlogPro.<br/>
						</span><span class="slider-subtext">with custom sections</span></h2>
					 	<a href="#" class="slider-btn">Read More <i class="icon-angle-right"></i></a>

				</div>


			</li>
			<li data-transition="fade" data-slotamount="10"  >
				<img src="<?php echo $this->base_url;?>/images/bg2.jpg" data-fullwidthcentering="on">

				<div class="caption slider-content left-side sfl stl"
					 data-x="0"
					 data-y="130"
					 data-speed="300"
					 data-start="500"
					 data-easing="easeOutExpo">

						<h2><span class="slider-text">
						Build Amazing, <br/>
						Ultra-Responsive Sites<br />
						</span><span class="slider-subtext">Subtext Yes.</span></h2>
					 	<a href="#" class="slider-btn">Read More <i class="icon-angle-right"></i></a>

				</div>
			</li>


			<li data-transition="fade" data-slotamount="10"  >

					<img src="<?php echo $this->base_url;?>/images/bg3.jpg" data-fullwidthcentering="on">

					<div class="caption fade fullscreenvideo"
						data-autoplay="false"
						data-x="0"
						data-y="0"
						data-speed="500"
						data-start="10"
						data-easing="easeOutBack">
							<iframe width="100%" height="100%" src="//www.youtube.com/embed/CL1jPb0_Auc?wmode=opaque" frameborder="0" allowfullscreen></iframe>
					</div>

			</li>

		<?php
	}

   function section_template( ) {


	?>
	<div class="revslider-container">
			<div class="revslider-full" style="display:none;max-height:480px;height:480px;">
				<ul>
					<?php

						$slides = $this->render_slides();

						if( $slides == '' ){
							$this->default_slides();
						} else {
							echo $slides;
						}
					?>

				</ul>

				<div class="tp-bannertimer tp-bottom"></div>
			</div>
		</div>

		<?php
	}


}