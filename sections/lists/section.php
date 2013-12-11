<?php
/*
	Section: Lists
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: An amazing, professional Features List section.
	Class Name: PLList
	Edition: pro
	Filter: component
	Loading: active
	Version: 1.0.1
*/


class PLList extends PageLinesSection {

	var $default_limit = 4;

	function section_head() {
    ?>
        <style type="text/css">
			.list-wrap{
				background: <?php echo pl_hashify($this->opt('list_background_color')); ?>;
			}
			.list-wrap h2.head, .list-wrap p.subhead, .list-wrap li{
				color: <?php echo pl_hashify($this->opt('list_text_color')); ?>;
			}
            .list-wrap .header .title,
			.list-wrap i{
                color: <?php echo pl_hashify($this->opt('list_title_color')); ?>;
            }
        </style>
    <?php
    }

	function section_opts(){
		$options = array();

		$options[] = array(

			'title' => __( 'List Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'		=> 'list_head',
					'label'		=> __( 'Heading', 'pagelines' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'list_subhead',
					'label'		=> __( 'Subheading', 'pagelines' ),
					'type'		=> 'text'
				),
				array(
					'key'			=> 'list_count',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> 6,
					'label' 	=> __( 'Number of Lists to Configure', 'pagelines' ),
				),
				array(
					'key'			=> 'list_cols',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> '4',
					'label' 	=> __( 'Number of Columns for Each List (12 Col Grid)', 'pagelines' ),
				),
				array(
					'key'		=> 'list_icons',
					'label'		=> __( 'List Icons', 'pagelines' ),
					'type'		=> 'select_icon',
					'help'		=> '<strong>Help: <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/">Icon Reference</a></strong>',
				),
				array(
                    'key' => 'list_background_color',
                    'type' => 'color',
                    'label' => __('Background Color', 'pagelines'),
                    'default' => '#23313A'
                ),
				array(
                    'key' => 'list_text_color',
                    'type' => 'color',
                    'label' => __('Content Color', 'pagelines'),
                    'default' => '#ffffff'
                ),
				array(
                    'key' => 'list_title_color',
                    'type' => 'color',
                    'label' => __('List Title/Icons Color', 'pagelines'),
                    'default' => '#1FB4DA'
                ),
			)

		);
	
		$lists = ($this->opt('list_count')) ? $this->opt('list_count') : $this->default_limit;
	
		for($i = 1; $i <= $lists; $i++){

			$opts = array(

				array(
					'key'		=> 'list_title_'.$i,
					'label'		=> __( 'List Title', 'pagelines' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'list_item_'.$i,
					'label'	=> __( 'List Item', 'pagelines' ),
					'type'	=> 'textarea',
					'help'	=> __( 'Add each item on a new line. Add a "*" in front to add emphasis.', 'pagelines' ),
				),
			);


			$options[] = array(
				'title' 	=> __( 'List ', 'pagelines' ) . $i,
				'type' 		=> 'multi',
				'opts' 		=> $opts,

			);

		}

		return $options;
	}


   function section_template( ) { 
		
		$listhead = $this->opt('list_head') ? $this->opt('list_head') : 'List Heading';
		$listsubhead = $this->opt('list_subhead') ? $this->opt('list_subhead') : 'List Subheading';

		$headings = sprintf(
			'<div class="row pl-animation pl-appear fix">
				<h2 class="head">%1$s</h2>
				<p class="subhead">%2$s</p>
			</div>',
			$listhead,
			$listsubhead
		);
				
		$cols = ($this->opt('list_cols')) ? $this->opt('list_cols') : 4;
		$num = ($this->opt('list_count')) ? $this->opt('list_count') : $this->default_limit;
		$listicons = ($this->opt('list_icons')) ? $this->opt('list_icons') : 'ok-sign';
		$width = 0;
		$output = '';
	
		$master = array();
		for($i = 1; $i <= $num; $i++){
			
			$master[$i]['title'] = ($this->opt('list_title_'.$i)) ? $this->opt('list_title_'.$i) : 'List Title'; 
			
			$master[$i]['attr'] = ($this->opt('list_item_'.$i)) ? $this->opt('list_item_'.$i) : '';
			
		}

		foreach($master as $i => $list){
			
			
			$title 		= $list['title'];
			$attr 		= $list['attr']; 
		
		
			$attr_list = ''; 
			
			if($attr != ''){
				
				$attr_array = explode("\n", $attr);
				
				foreach($attr_array as $at){
					
					if(strpos($at, '*') === 0){
						$at = str_replace('*', '', $at); 
						$attr_list .= sprintf('<li class="emphasis"><i class="icon-%s"></i> %s</li>', $listicons, $at); 
					} else {
						$attr_list .= sprintf('<li><i class="icon-%s"></i> %s</li>', $listicons, $at); 
					}
					
				}
				
			} 
		
			
			$attr_list = $attr_list; 
			
			$formatted_attr = ($attr_list != '') ? sprintf('<div class="attributes"><ul>%s</ul></div>', $attr_list) : '';
		
			if($width == 0)
				$output .= '<div class="row fix">';

			$output .= sprintf(
				'<div class="span%1$s list pl-animation pl-appear fix">
					<div class="header">
						<div class="title" data-sync="list_title_%4$s">
							%2$s
						</div>
					</div>
					%3$s
				</div>',
				$cols,
				$title,
				$formatted_attr, 
				$i
			);

			$width += $cols;

			if($width >= 12 || $i == $num){
				$width = 0;
				$output .= '</div>';
			}


		 }
	
	
	?>
	
	<div class="list-wrap pl-animation-group">
		<?php echo $headings; ?>
		<?php echo $output; ?>
	</div>

<?php }


}
