<?php
/*
	Section: WHiteHousePro Notibar
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A simple optimization tool that allows you to show the right message at the right time to your website visitors
	Class Name: WHPNotibar
	Filter: component, full-width
*/

class WHPNotibar extends PageLinesSection {

	function section_styles(){

		wp_enqueue_script( 'revolution-plugins', $this->base_url.'/whoahbar.js', array( 'jquery' ), pl_get_cache_key(), true );

	}
	

	function section_opts(){
		$opts = array(
			array(
				'col'		=> 2,
				'type' 		=> 'textarea',
				'key'		=> 'ishoutbox_content',
				'label'		=> __( 'iShoutBox Content', 'pagelines' ),
				'help' 		=> __( 'This area supports text and HTML', 'pagelines' ),
			),
			array(
				'type'		=> 'multi',
				'key'		=> 'ishoutbox_settings', 
				'label' 	=> __( 'iShoutBox Settings', 'pagelines' ),
				'opts'		=> array(
					array(
						'type' 			=> 'select',
						'key'			=> 'ishoutbox_align',
						'label' 		=> 'Alignment',
						'opts'			=> array(
							'textcenter'	=> array('name' => 'Center (Default)'),
							'textleft'		=> array('name' => 'Align Left'),
							'textright'		=> array('name' => 'Align Right'),
							'textjustify'	=> array('name' => 'Justify'),
						)
					),	
				array(
						'key'		=> 'ishoutbox_pad',
						'type' 		=> 'text',
						'label' 	=> __( 'Padding <small>(CSS Shorthand)</small>', 'pagelines' ),
						'ref'		=> __( 'This option uses CSS padding shorthand. For example, use "15px 30px" for 15px padding top/bottom, and 30 left/right.', 'pagelines' ),
						'default' 	=> '5px',
						
					),				
				)
			),
		);

		return $opts;

	}


	function section_template() {

		$content = $this->opt('ishoutbox_content');
		
		$content = (!$content) ? '<p><strong>iShoutBox</strong> &raquo; Add Content or any HTML!</p>' : sprintf('%s', do_shortcode( wpautop($content) ) ); 
			
		$align = ($this->opt('ishoutbox_align', $this->oset)) ? $this->opt('ishoutbox_align', $this->oset) : 'center';
		
		$padding = ($this->opt('ishoutbox_pad')) ? sprintf('padding: %s;', $this->opt('ishoutbox_pad')) : ''; 
		
		
		//printf('<div class="ishoutbox-wrap fade in %s" style="%s">%s <button type="button" class="close-ishoutbox" href="#" data-dismiss="alert">×</button></div>', $align, $padding, $content);
		
		?>

		
		<div class="woahbar" style="display:none">
		   <span>
		       Welcome to Jobdeals! Need some help from a local service pro? <a class="woahbar-link" href="/request-services/">Request a Service FREE</a>
		    </span>
		    <a class="close-notify" onclick="woahbar_hide();"><img class="woahbar-up-arrow" src="woahbar-up-arrow.png"></a>
		</div>
		<div class="woahbar-stub" style="display:none">
		    <a class="show-notify" onclick="woahbar_show();"><img class="woahbar-down-arrow" src="woahbar-down-arrow.png"></a>
		</div>
		

		<?php 
	}
}


