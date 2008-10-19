<?php

	$i = 1;
	$j = 1;
	$output = '';
	
	foreach ($productList AS $item) {
		if ($j >= 3) {
			$j = 1;
			$class = 'product right';
		} else {
			$j++;
			$class = 'product';
		}
		
		$output .= '<a href="'.$html->url('/'.$paramMain.'/'.$paramBy.'/'.$paramList.'/'.$item['Menu']['slug']).'" id="product'.$i.'" ';
		$output .= 'class="'.$class.'" style="background-image:url('.$html->url('/files/'.$item['Media']['name']).')">';
		$output .= '<span>'.$item['Menu']['name'].'</span>';
		$output .= '</a>';
		
		if (!empty($item['Page']['txt_short'])) {
			$output .= '<div id="tooltip'.$i.'" class="tooltip" style="display:none">';
			$output .= '<div class="cbb">';
			$output .= Markdown($item['Page']['txt_short']);
			$output .= '</div>';
			$output .= '</div>';
		}
		
		$i++;
	}
	
	echo $output;
	
?>