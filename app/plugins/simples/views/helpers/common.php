<?php

	class CommonHelper extends Helper {
		
		public $helpers = array('Common');
		
		
		public function createModifiedTimestamp($timestamp) {
			$output = '<p class="quicknote">';
			
			if (!empty($timestamp)) {
				$date = date('d.m.Y', $timestamp);
				$time = date('H:i:s', $timestamp);
				
				if (date('Y-m-d', $timestamp) == date('Y-m-d', time())) {
					$output .= 'Zuletzt gespeichert, <b>Heute</b> um <b>'.$time.' Uhr</b>';
				} else {
					$output .= 'Zuletzt gespeichert am <b>'.$date.'</b> um <b>'.$time.' Uhr</b>';
				}
			}
			
			$output .= '</p>';
			return $output;
		}
		
	}

?>