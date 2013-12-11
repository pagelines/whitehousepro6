<?php
/*
	Section: ShoutBox
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A simple shout box.
	Class Name: PLShoutBox
	Edition: pro
	Filter: component
	Loading: active
*/

class PLShoutBox extends PageLinesSection {
	
	function section_head(){
		
		$background_color = ($this->opt('shoutbox_background_color', $this->oset)) ? $this->opt('shoutbox_background_color', $this->oset) : 'ee3319';
			
		?>
	
		<style><?php echo $this->prefix(); ?> .shoutbox-wrap { background-color: #<?php echo $background_color; ?>; }</style>	
		
		<?php
	}

	function section_opts(){
		$opts = array(
			array(
				'type' 			=> 'textarea',
				'key'			=> 'shoutbox_content',
				'label' 		=> __( 'ShoutBox Content', 'pagelines' ),
			),
			array(
				'type'		=> 'multi',
				'key'		=> 'shoutbox_settings', 
				'label' 		=> __( 'ShoutBox Settings', 'pagelines' ),
				'opts'		=> array(
					array(
						'key'			=> 'shoutbox_background_color',
						'type' 			=> 'color',
						'label' 		=> __( 'Background Color', 'pagelines' ),
						'default' 		=> 'ee3319',
					),
					array(
						'key'			=> 'shoutbox_pad',
						'type' 			=> 'text',
						'label' 	=> __( 'Padding <small>(CSS Shorthand)</small>', 'pagelines' ),
						'ref'		=> __( 'This option uses CSS padding shorthand. For example, use "15px 30px" for 15px padding top/bottom, and 30 left/right.', 'pagelines' ),
						'default' 		=> '5px',
						
					),
					array(
						'key'			=> 'shoutbox_font_size',
						'type'			=> 'count_select',
						'count_start'	=> 10,
						'count_number'	=> 30,
						'suffix'		=> 'px',
						'title'			=> __( 'Font Size', 'pagelines' ),
						'default'		=> '', 
					),
					
					array(
						'type' 			=> 'select',
						'key'			=> 'shoutbox_align',
						'label' 		=> 'Alignment',
						'opts'			=> array(
							'textcenter'	=> array('name' => 'Center (Default)'),
							'textleft'		=> array('name' => 'Align Left'),
							'textright'		=> array('name' => 'Align Right'),
							'textjustify'	=> array('name' => 'Justify'),
						)
					),					
				)
			),
		);

		return $opts;

	}


	function section_template() {

		$content = $this->opt('shoutbox_content');
		
		$content = (!$content) ? '<p><strong>ShoutBox</strong> &raquo; Add Content!</p>' : sprintf('%s', do_shortcode( wpautop($content) ) ); 
			
		$align = ($this->opt('shoutbox_align', $this->oset)) ? $this->opt('shoutbox_align', $this->oset) : 'center';
		
		$padding = ($this->opt('shoutbox_pad')) ? sprintf('padding: %s;', $this->opt('shoutbox_pad')) : ''; 
		
		$fontsize = ($this->opt('shoutbox_font_size')) ? sprintf('font-size: %spx;', $this->opt('shoutbox_font_size')) : ''; 
		
		printf('<div class="shoutbox-wrap fade in %s" style=" %s %s ">%s <button type="button" class="close-shoutbox" href="#" data-dismiss="alert">×</button></div>', $align, $padding, $fontsize, $content);
		
	}
}


