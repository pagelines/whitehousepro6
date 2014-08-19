<?php
/*
	Section: WhiteHousePro Slider
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A professional and versatile slider section. Can be customized with several transitions and a large number of slides.
	Class Name: WHPSlider
	Filter: slider
*/


class WHPSlider extends PageLinesSection {

	var $default_limit = 2;

	function section_styles(){
        wp_enqueue_script( 'flexslider', PL_JS . '/script.flexslider.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'flexslider-custom', $this->base_url.'/whp.slider.js',  pl_get_cache_key(), true );
		wp_enqueue_style(  'flexslider-styles', sprintf( '%s/flexslider.css', $this->base_url ), null, pl_get_cache_key() );
		
	}

	function section_opts(){

		$options = array();

		$options[] = array(

			'title' => __( 'Slider Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
                array(
                    'key'           => 'autoplay',
                    'type'          => 'check',
                    'default'       => 'false',
                    'label'         => __( 'Play Slideshow?', 'pagelines' ),
                ),
				array(
					'key'			=> 'speed',
					'type' 			=> 'text_small',
					'default'		=> 4000,
					'label' 		=> __( 'Time Per Slide in Milliseconds (e.g. 4000)', 'pagelines' ),
				),
			)

		);

		$options[] = array(
            'key'       => 'whpslider_array',
            'type'      => 'accordion', 
            'col'       => 2,
            'title'     => __('WhiteHousePro Setup', 'pagelines'), 
            'post_type' => __('Slide', 'pagelines'), 
            'opts'  => array(
                array(
                    'key'       => 'image',
                    'label'     => __( 'Slide  Image <span class="badge badge-mini badge-warning">REQUIRED</span>', 'pagelines' ),
                    'type'      => 'image_upload',
                    'sizelimit' => 2097152, // 2M
                    'help'      => __( 'For high resolution, 2000px wide x 800px tall images. (2MB Limit)', 'pagelines' )
                    
                ),
                array(
                    'key'       => 'title',
                    'label'     => __( 'Title', 'pagelines' ),
                    'type'      => 'text',
                ),
                array(
                    'key'       => 'text',
                    'label'     => __( 'Text', 'pagelines' ),
                    'type'      => 'text'
                ),
                array(
					'key'	  => 'location',
					'label'   => __( 'Slide Text Location', 'pagelines' ),
					'type'	  => 'select',
					'opts'	=> array(
						'slide-left'	=> array('name'=> 'Content On Left (Default)'),
						'slide-right'	=> array('name'=> 'Content On Right'),
					)
				),
                array(
                    'key'   => 'link',
                    'label' => __( 'Primary Button Link (Optional)', 'pagelines' ),
                    'type' 	=> 'text'
                ),
                array(
                    'key'  	=> 'link_text',
                    'label'	=> __( 'Primary Button Text', 'pagelines' ),
                    'type'  => 'text'
                ),
                array(
                    'key'       => 'button_color',
                    'label'     => __( 'Primary Button Style', 'pagelines' ),
                    'type'      => 'select',
                    'default'   => 'whp-red',
                    'opts'      => array(
                        'whp-red'    => array('name'=> 'Red'),
                        'whp-silver' => array('name'=> 'Silver'),                   
                    )
                ),
                array(
                    'key'   => 'link2',
                    'label' => __( 'Secondary Button Link (Optional)', 'pagelines' ),
                    'type'  => 'text'
                ),
                array(
                    'key'   => 'link_text2',
                    'label' => __( 'Secondary Button Text', 'pagelines' ),
                    'type'  => 'text'
                ),
                array(
                    'key'       => 'button_color2',
                    'label'     => __( 'Secondary Button Style', 'pagelines' ),
                    'type'      => 'select',
                    'default'   => 'whp-red',
                    'opts'      => array(
                        'whp-red'    => array('name'=> 'Red'),
                        'whp-silver' => array('name'=> 'Silver'),                   
                    )
                ),
            )
        );

		return $options;
	}
	
	function slides_output( $whpslider_array ){

        $count = 1; 
        
        $output = '';
        
        if( is_array($whpslider_array) ){
            
            foreach( $whpslider_array as $slide ){

                $the_img = pl_array_get( 'image', $slide );

                if( $the_img ){
 
                    $title = pl_array_get( 'title', $slide);

                    $text = pl_array_get( 'text', $slide); 

                    $location = pl_array_get( 'location', $slide ); 

                    $location = ( $location ) ? $location : 'slide-left';   

                    $link = pl_array_get( 'link', $slide);

                    $link_text = pl_array_get( 'link_text', $slide ); 

                    $link2 = pl_array_get( 'link2', $slide);

                    $link_text2 = pl_array_get( 'link_text2', $slide );    

                    $the_img = pl_array_get( 'image', $slide );

                    $the_img = ( $the_img ) ? $the_img : $this->base_url.'/images/default.jpg';

                    $img = sprintf('<div class="slide-image"><img src="%s" alt="%s"></div>', $the_img, $title);  

                    $button_color = pl_array_get( 'button_color', $slide );

                    $button_color = ( $button_color ) ? $button_color : 'whp-red';  

                    $button_color2 = pl_array_get( 'button_color2', $slide );

                    $button_color2 = ( $button_color2 ) ? $button_color2 : 'whp-silver';  

                    $title = sprintf('<h2 data-sync="whpslider_array_item%s_title" class="title">%s</h2>', $count, $title);

                    $text = sprintf('<p data-sync="whpslider_array_item%s_text">%s</p>', $count, $text);

                    if( $link ){
                        $link_text = sprintf('<a data-sync="whpslider_array_item%s_link_text" href="%s" class="whp-btn %s">%s <i class="icon icon-angle-double-right"></i></a>', $count, $link, $button_color, $link_text);
                    } else { 
                        $link_text = '';
                    };

                    if( $link2 ){
                        $link_text2 = sprintf('<a data-sync="whpslider_array_item%s_link_text2" href="%s" class="whp-btn %s">%s <i class="icon icon-angle-double-right"></i></a>', $count, $link2, $button_color2, $link_text2);
                    } else { 
                        $link_text2 = '';
                    };

                    $description = sprintf(
                        '<div class="slide-description">
                            %s %s %s %s
                        </div>',
                        $title, 
                        $text, 
                        $link_text,
                        $link_text2
                    );

                    $output .= sprintf(
                        '<li class="%s">
                            %s %s
                        </li>',
                        $location,
                        $description,
                        $img
                    );
                
                }

                $count++;
            }

        }

        return $output;    
    }


    function section_template( ) {

        $whpslider_autoplay = ( $this->opt('autoplay') ) ? 'true' : 'false';

		$whpslider_speed = $this->opt('speed');
        
        $whpslider_array = $this->opt('whpslider_array');
        
        $whpslides = $this->slides_output( $whpslider_array );
    
        if( $whpslides == '' ){
            
            $whpslider_array = array(
                array(
                    'image'         => $this->base_url . '/images/default.jpg',
                    'button_color'  => 'whp-red',
                    'location'		=> 'slide-left',
                    'title'         => 'WhiteHousePro Slider',
                    'text'          => 'Congrats! <br /> You have successfully installed this slider.<br /> Now just set it up.',
                    'link'          => 'http://www.pagelines.com/',
                    'link_text'     => 'Visit PageLines.com'
                ),
                
            );
            
            $whpslides = $this->slides_output( $whpslider_array );
        }


        printf('
            <div class="pl-area-wrap whp-slider-wrap" data-autoplay="%s" data-speed="%s">
				<div class="whp-slider flexslider">
            		<ul class="slides">
                    	%s
                    </ul>
	            </div>
			</div>',
            $whpslider_autoplay,
            $whpslider_speed,
            $whpslides
        );
            

	}



    


}