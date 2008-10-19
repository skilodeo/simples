<?php

	class ListHelper extends Helper {
		
		public $helpers = array('Html');
		
		
		/**
		 * Create menu list
		 *
		 * @param array $menuStructure
		 * @param string $pageSlug
		 * @return html list of menu
		 */
		public function createMenuList($menuStructure,$pageSlug=null) {
			$output = '';
			
			foreach ($menuStructure AS $item) {
				$output .= '<ul class="menu">'; 
				$output .= '<li class="title">'.$item['Menu']['name'].'</li>';
				
				foreach ($item['children'] AS $child) {
					if ($child['Menu']['slug'] == $pageSlug) {
						$class = ' class="on"';
					} else {
						$class = '';
					}
					
					$output .= '<li'.$class.'>';
					$output .= $this->Html->link($child['Menu']['name'], '/'.$item['Menu']['slug'].'/'.$child['Menu']['slug']);
					$output .= '</li>';
				}
				
				$output .= '</ul>';
			}
			
			return $output;
		}
		
		/**
		 * Create product list
		 *
		 * @param array $list
		 * @param string $lang
		 * @return html list of products
		 */
		public function createProductList($list,$lang) {
			$output = '';
			
			if (!empty($list)) {
				$i = 1;
				$j = 1;
				
				foreach ($list AS $item) {
					if (!empty($item['Page']['name']) && !empty($item['Media']['name'])) {
						if ($j >= 3) {
							$j = 1;
							$class = 'product right';
						} else {
							$j++;
							$class = 'product';
						}
						
						$output .= '<a href="'.$this->Html->url('/'.$lang.'/products/details/'.$item['Page']['name']).'" id="product'.$i.'" ';
						$output .= 'class="'.$class.'" style="background-image:url('.$this->Html->url('/files/'.$item['Media']['name']).')">';
						$output .= '<span>'.$item['Page']['name'].'</span>';
						$output .= '</a>';
						
						if (!empty($item['Page']['txt_short']))
						{
							$output .= '<div id="tooltip'.$i.'" class="tooltip" style="display:none">';
							$output .= '<div class="cbb">';
							$output .= Markdown($item['Page']['txt_short']);
							$output .= '</div>';
							$output .= '</div>';
						}
						
						$i++;
					}
				}
			} else {
				$output .= __('search:no_results', TRUE);
			}
			
			return $output;
		}
		
	}

?>