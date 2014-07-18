<?php
/*
	Section: Quickstagram
	Author: PageLines
	Author URI: http://www.raylo.net
	Description: A simple Instagram section.
	Class Name: Quickstagram
	Filter: social
	Loading: active
*/


class Quickstagram extends PageLinesSection {

	function section_styles(){
		wp_enqueue_script( 'spectagram', $this->base_url . '/spectagram.min.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'quickstagram', $this->base_url . '/quickstagram.js', array('jquery'), pl_get_cache_key(), true);

	}

	function section_opts(){

	
		$opts = array(
		
			array(
				'type'	=> 'multi',
				'key'	=> 'sl_config', 
				'title'	=> 'Text',
				'col'	=> 1,
				'opts'	=> array(
					array(
						'type'	=> 'text',
						'help'  => __( 'In order to use the section you need to register an application at <a href="http://instagram.com/developer/">Instagram Developers</a>, get a <strong>client_id</strong> and recieve an <a href="http://instagram.com/developer/authentication/">access_token</a>', 'pagelines' ),
					),
				)
				
			),			

		);

		return $opts;

	}
	
	function section_head(){ 
		?>
	<script type="text/javascript">
		
					jQuery.fn.spectragram.accessData = {
					    accessToken: '7726041.ef73649.c2029c8d702e4d8ebe9a42c53c7d04da',
					    clientID: 'c16927dd9f47428fae6fa97e713b2fca'
					};
		</script>

	 	<?php 
	}
		
	
	
   function section_template( $location = false ) {
   	?>

	
   	<?php


		$align = ( $this->opt('sl_align') ) ? $this->opt('sl_align') : 'sl-links-right';

	?>
	<div class="quickstagram-wrap fix <?php echo $align;?>">
		<ul class="quickstagram"></ul>
		
	</div>
<?php }

}
