<?php
/*
Section: WhiteHousePro Ads
Author: PageLines
Author URI: http://www.pagelines.com
Description: A simple and versatile ad section. 
Class Name: WHPAds
Filter: Miscellaneous
*/


class WHPAds extends PageLinesSection
{
    
    var $default_limit = 2;
    
    function section_opts(){
        
        $options = array();

        $options[] = array(

            'title' => __( 'Ads Configuration', 'pagelines' ),
            'key'   => 'ads_config',
            'type'  => 'multi',
            'opts'  => array(
                array(
                    'key'           => 'ads_cols',
                    'type'          => 'count_select',
                    'count_start'   => 1,
                    'count_number'  => 12,
                    'default'       => '4',
                    'label'     => __( 'Number of Columns for Each Ad (12 Col Grid)', 'pagelines' ),
                ),
            )

        );

        $options[] = array(
            'key'       => 'ads_array',
            'type'      => 'accordion', 
            'col'       => 2,
            'title'     => __('Ads', 'pagelines'), 
            'post_type' => __('Ad', 'pagelines'), 
            'opts'  => array(
                array(
                    'key'       => 'image',
                    'label'     => __( 'Ad Image <span class="badge badge-mini badge-warning">REQUIRED</span>', 'pagelines' ),
                    'type'      => 'image_upload',
                    'sizelimit' => 2097152, // 2M
                    'help'      => __( 'Recommended Size: 200px wide x 125px.', 'pagelines' )
                    
                ),
                array(
                    'key'       => 'link',
                    'label'     => __( 'Link', 'pagelines' ),
                    'type'      => 'text'
                ),
            )
        );
        
        
        return $options;
    }
    
    function slides_output( $ads_array ){

        $cols = ($this->opt('ads_cols')) ? $this->opt('ads_cols') : 6;

        $width = 0;

        $count = 1; 
        
        $output = '';
        
        if( is_array($ads_array) ){

            $the_ads = count( $ads_array );
            
            foreach( $ads_array as $ad ){

                $the_img = pl_array_get( 'image', $ad );

                if( $the_img ){
 
                    $link = pl_array_get( 'link', $ad);

                    $the_img = pl_array_get( 'image', $ad );

                    $the_img = ( $the_img ) ? $the_img : $this->base_url.'/whpads/thumb.png';

                    $img = sprintf('<img src="%s" alt="">', $the_img);   

                    if( $link ){
                        $the_ad = sprintf('<a data-sync="ads_array_item%s_link" href="%s">%s</a>', $count, $link, $img);
                    } else { 
                        $the_ad = '';
                    };

                    if($width == 0)
                    $output .= '<div class="row fix">';

                    $output .= sprintf(
                        '<li class="span%s">%s</li>',
                        $cols,
                        $the_ad
                    );


                    $width += $cols;

                    if($width >= 12 || $count == $the_ads){
                        $width = 0;
                        $output .= '</div>';
                    }
                
                }

                $count++;
            }

        }

        return $output;    
    }

    function section_template( ) {
        
        $ads_array = $this->opt('ads_array');
        
        $ads = $this->slides_output( $ads_array );
    
        if( $ads == '' ){
            
            $ads_array = array(
                array(
                    'image'         => $this->base_url . '/thumb.png',
                    'link'          => 'http://www.pagelines.com/'
                ),
                array(
                    'image'         => $this->base_url . '/thumb.png',
                    'link'          => 'http://www.pagelines.com/'
                ),
                array(
                    'image'         => $this->base_url . '/thumb.png',
                    'link'          => 'http://www.pagelines.com/'
                ),
                array(
                    'image'         => $this->base_url . '/thumb.png',
                    'link'          => 'http://www.pagelines.com/'
                ),
                
            );
            
            $ads = $this->slides_output( $ads_array );
        }


        printf('
            <div class="ads-container">
                <ul class="ads">
                    %s
                </ul>
            </div>', $ads);
	}
}