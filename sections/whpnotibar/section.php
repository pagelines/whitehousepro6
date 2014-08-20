<?php
/*
	Section: WhiteHousePro Notibar
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: An optimization tool that allows you to show the right message at the right time to your website visitors.
	Class Name: WHPNotibar
	Filter: component, full-width
*/

class WHPNotibar extends PageLinesSection {

	function section_styles(){

		wp_enqueue_script( 'jbar', $this->base_url.'/jbar.min.js', array( 'jquery' ), true );

	}
	

	function section_opts(){

		$options = array();

		$options[] = array(

			'title' => __( 'Notibar Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'col'		=> 1,
			'opts'	=> array(
				array(
					'type' 		=> 'text',
					'key'		=> 'notibar_text',
					'label'		=> __( 'Main Text <span class="badge badge-mini badge-warning">REQUIRED</span>', 'pagelines' ),
					'default'	=> 'Check Out PageLines DMS for WordPress',
					'help' 		=> __( 'This area supports text and HTML', 'pagelines' ),
				),
				array(
					'type' 		=> 'text',
					'key'		=> 'notibar_button',
					'default'	=> 'PageLines',
					'label'		=> __( 'Button Text', 'pagelines' ),
				),
				array(
					'type' 		=> 'text',
					'key'		=> 'notibar_button_url',
					'default'	=> 'http://www.pagelines.com/',
					'label'		=> __( 'Button Link', 'pagelines' ),
				),
				array(
					'type' 		=> 'select',
					'key'		=> 'notibar_state',
					'default'	=> 'open',
					'label'		=> __( 'Button State', 'pagelines' ),
					'opts'		=> array(
						'open'		=> array('name' => 'Open (Default)'),
						'closed'	=> array('name' => 'Closed'),
					)
				),
				/*array(
                    'key'       => 'notibar_style',
                    'label'     => __( 'Notibar Style', 'pagelines' ),
                    'type'      => 'select',
                    'default'   => 'whp-red',
                    'opts'      => array(
                        'whp-red'    => array('name'=> 'Red'),
                        'whp-silver' => array('name'=> 'Silver'),
                        'whp-cyan'   => array('name'=> 'Cyan'),
                        'whp-yellow' => array('name'=> 'Yellow'),                        
                    )
                ), */
			)

		);

		return $options;

	}


	function section_template() {

		//$notibar_style = ($this->opt('notibar_style', $this->oset)) ? $this->opt('notibar_style', $this->oset) : 'whp-red';

		$text = ($this->opt('notibar_text', $this->oset)) ? $this->opt('notibar_text', $this->oset) : 'Notibar is Ready';
		
		$button = ($this->opt('notibar_button', $this->oset)) ? $this->opt('notibar_button', $this->oset) : 'Engage your visitors!';

		$button_url = ($this->opt('notibar_button_url', $this->oset)) ? $this->opt('notibar_button_url', $this->oset) : 'http://pagelines.com';

		$state = ($this->opt('notibar_state', $this->oset)) ? $this->opt('notibar_state', $this->oset) : 'open'; 

		?>
					
		<div class="jbar whpnotibar" data-init="jbar" data-jbar='{
			"message" : "<?php echo $text; ?> <a href=\"<?php echo $button_url; ?>\" class=\"whpnotibar-button\"><?php echo $button; ?></a>",
			"state"   : "<?php echo $state; ?>"
		}'></div> 
	
	
	<?php 
	}
}


