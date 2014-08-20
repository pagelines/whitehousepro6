<?php
/*
	Section: WhiteHousePro Quotes
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A versatile quotes section with multiple options.
	Class Name: WHPQuotes
	Filter: slider
*/


class WHPQuotes extends PageLinesSection {

	var $default_limit = 2;

	function section_styles(){
        wp_enqueue_script( 'flexslider', PL_JS . '/script.flexslider.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'flexslider-quotes', $this->base_url.'/whp.quotes.js',  pl_get_cache_key(), true );
		wp_enqueue_style(  'flexslider-default', sprintf( '%s/flexslider.css', $this->base_url ), null, pl_get_cache_key() );
		
	}

	function section_opts(){

		$options = array();

		$options[] = array(

			'title' => __( 'Quotes Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
                array(
                    'key'           => 'autoplay',
                    'type'          => 'false',
                    'type'          => 'check',
                    'label'         => __( 'Play Slideshow?', 'pagelines' ),
                ),
				array(
					'key'			=> 'speed',
					'type' 			=> 'text_small',
					'default'		=> 4000,
					'label' 		=> __( 'Time Per Quote in Milliseconds (e.g. 4000)', 'pagelines' ),
				),
			)

		);

		$options[] = array(
            'key'       => 'whpquotes_array',
            'type'      => 'accordion', 
            'col'       => 2,
            'title'     => __('WhiteHousePro Setup', 'pagelines'), 
            'post_type' => __('Quote', 'pagelines'), 
            'opts'  => array(
                array(
                    'key'       => 'image',
                    'default'   => $this->base_url.'/default.jpg',
                    'label'     => __( 'Author Image <span class="badge badge-mini badge-warning">REQUIRED</span>', 'pagelines' ),
                    'type'      => 'image_upload',
                    'sizelimit' => 2097152, // 2M
                    'help'      => __( 'Image must have a 1:1 ratio, ex.100px wide x 100px tall images. (2MB Limit)', 'pagelines' )
                    
                ),
                array(
                    'key'       => 'quote',
                    'label'     => __( 'Quote', 'pagelines' ),
                    'type'      => 'text',
                ),
                array(
                    'key'       => 'author',
                    'label'     => __( 'Author', 'pagelines' ),
                    'type'      => 'text'
                ),
            )
        );

		return $options;
	}
	
	function get_quotes( $whpquotes_array ){

        $count = 1; 
        
        $output = '';
        
        if( is_array($whpquotes_array) ){
            
            foreach( $whpquotes_array as $quote ){

                $the_img = pl_array_get( 'image', $quote );

                if( $the_img ){
 
                    $quote_text = pl_array_get( 'quote', $quote);

                    $author = pl_array_get( 'author', $quote);    

                    $the_img = pl_array_get( 'image', $quote );

                    $the_img = ( $the_img ) ? $the_img : $this->base_url.'/default.jpg';

                    $img = sprintf('<div class="slide-image"><img src="%s" alt="%s"></div>', $the_img, $quote_text);   

                    $quote_text = sprintf('<h2 data-sync="whpquotes_array_item%s_quote">&ldquo; %s &rdquo;</h2>', $count, $quote_text);

                    $author = sprintf('<p data-sync="whpquotes_array_item%s_author">%s</p>', $count, $author);

                    $description = sprintf('<div class="quote-description">%s %s</div>', $quote_text, $author);

                    $output .= sprintf(
                        '<li data-thumb="%s">
                            %s
                        </li>',
                        $the_img,
                        $description
                    );
                
                }

                $count++;
            }

        }

        return $output;    
    }


    function section_template( ) {

        $whpquotes_autoplay = ( $this->opt('autoplay') ) ? 'true' : 'false';

		$whpquotes_speed = $this->opt('speed');
        
        $whpquotes_array = $this->opt('whpquotes_array');
        
        $whpquotes = $this->get_quotes( $whpquotes_array );
    
        if( $whpquotes == '' ){
            
            $whpquotes_array = array(
                array(
                    'image'         => $this->base_url . '/default.jpg',
                    'quote'         => 'Congrats! You have successfully installed WhiteHousePro Quotes. Now just set it up.',
                    'author'          => 'PageLines'
                ),
                
            );
            
            $whpquotes = $this->get_quotes( $whpquotes_array );
        }


        printf('
            <div class="pl-area-wrap whp-quotes-wrap" data-autoplay="%s" data-speed="%s">
				<div class="whp-quotes">
            		<ul class="slides">
                    	%s
                    </ul>
	            </div>
			</div>',
            $whpquotes_autoplay,
            $whpquotes_speed,
            $whpquotes
        );
            

	}



    


}