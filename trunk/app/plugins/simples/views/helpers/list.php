<?php

	class ListHelper extends Helper {
		
		public $helpers = array('Html');
		
		
		/**
		 * Create table of pages.
		 *
		 * @param array $list
		 * @param string $domain
		 * @return html table
		 */
		public function createPageTable($list,$domain) {
			$i = 1;
			$output = '';
			
			if (!empty($list)) {
				foreach ($list AS $item) {
					if ($i%2 == 0) { $trClass = ' class="alt"'; } else { $trClass = ''; }
					
					$link	= $this->Html->link($item['MyPage']['name'], '/simples/my_pages/edit/'.$item['MyPage']['id']);
					$date	= '-';
					$author	= '-';
					
					$output .= '<tr'.$trClass.'>';
						$output .= '<th scope="row" class="check"><input type="checkbox" value="'.$item['MyPage']['id'].'" name="group" /></th>';
						$output .= '<td class="name">'.$link.'</td>';
						$output .= '<td>'.$date.'</td>';
						$output .= '<td>'.$author.'</td>';
					$output .= '</tr>';
					
					$i++;
				}
			} else {
				$output .= '<tr><td colspan="4">'.__d($domain, 'error:list_empty', true).'</td></tr>';
			}
			
			return $output;
		}
		
		/**
		 * Create table of menu items.
		 *
		 * @param array $list
		 * @param string $domain
		 * @param int $depth
		 * @param int $count
		 * @return html table
		 */
		public function createMenuTable($list,$domain,$depth=0,$count=1)
		{
			$indent = 15;
			$output = '';
			
			if (!empty($list)) {
				for ($i=0; $i<count($list); $i++) {
					$item = $list[$i];
					($count%2 == 0) ? $trClass = ' class="alt"' : $trClass = '';
					
					$name = $this->Html->link($item['MyMenu']['name'], '/simples/my_menus/edit/'.$item['MyMenu']['id'], array('style' => 'margin-left:'.($depth*$indent).'px'));
					$page = '-';
					
					$moveDown = '';
					if (!empty($list[$i+1])) {
						$moveDown	= $this->Html->link('', '/simples/my_menus/move/down/'.$item['MyMenu']['id'], array('class' => 'move down', 'title' => 'runter'));
					}
					
					$moveUp = '';
					if (!empty($list[$i-1])) {
						(!empty($moveDown)) ? $class = 'move up' : $class = 'move up indent';
						$moveUp = $this->Html->link('', '/simples/my_menus/move/up/'.$item['MyMenu']['id'], array('class' => $class, 'title' => 'hoch'));
					}
					
					if ($item['MyMenu']['publish'] == 0) {
						 $publishOptions = array('class' => 'publish false', 'title' => 'veröffentlichen');
					} else if ($item['MyMenu']['publish'] == 1) {
						$publishOptions = array('class' => 'publish true', 'title' => 'nicht veröffentlichen');
					}
					$publish = $this->Html->link('', '/simples/my_menus/publish/'.$item['MyMenu']['id'], $publishOptions);
					
					$output .= '<tr'.$trClass.'>';
						$output .= '<th scope="row" class="check"><input type="checkbox" value="'.$item['MyMenu']['id'].'" name="group" /></th>';
						$output .= '<td class="name">'.$name.'</td>';
						$output .= '<td>'.$moveDown.$moveUp.'</td>';
						$output .= '<td>'.$page.'</td>';
						$output .= '<td>'.$publish.'</td>';
					$output .= '</tr>';
					
					$count++;
					
					if (!empty($item['children'])) {
						$output .= $this->createMenuTable($item['children'],$domain,$depth+1,$count);
					}
				}
			} else {
				$output .= '<tr><td colspan="5">'.__d($domain, 'error:list_empty', true).'</td></tr>';
			}
			
			return $output;
		}
		
		/**
		 * Create list of media items.
		 *
		 * @param array $list
		 * @param int $pageId
		 * @param string $imgKey
		 * @return html list
		 */
		public function createMediaList($list,$pageId,$imgKey) {
			$output = '<ul class="media">';
				if (!empty($list)) {
					foreach ($list AS $item) {
						$output .= '<li>';
						$output .= $this->Html->link($item['MyMedia']['name'], '/files/'.$item['MyMedia']['name'], array('class' => 'thickbox'));
						$output .= '&nbsp;&nbsp;&nbsp;('.$this->Html->link('entfernen', '/simples/my_pages/del_img/'.$pageId.'/'.$imgKey.'/'.$item['MyMedia']['id']).')';
						$output .= '</li>';
					}
				} else {
					$output .= '<li>Kein Bild vorhanden.</li>';
				}
			$output .= '</ul>';
			
			return $output;
		}
		
	}

?>