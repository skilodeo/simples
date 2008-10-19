<h1><?= $productData['Page']['name']; ?></h1>
<h3>
	<?= $html->link('Zurück zur Übersicht', '/'.$paramMain.'/'.$paramBy.'/'.$paramList) ?>
</h3>

<?php
	
	if (!empty($imageData))
	{
		$i = 1;
		$output = '';
		
		foreach ($imageData AS $item)
		{
			if ($i > 1) { $class = ' hide'; } else { $class = ''; }
			
			$output .= '<div id="image'.$i.'" class="img-file'.$class.'" style="background-image:url('.$html->url('/files/'.$item['Media']['name']).')">';
			$output .= '<span class="img-border">&nbsp;</span>';
			$output .= '</div>';
			
			$i++;
		}
		
		$output .= '<input type="hidden" name="img-now" id="img-now" value="1" />';
		$output .= '<input type="hidden" name="img-count" id="img-count" value="'.($i-1).'" />';
		
		echo $output;
	}

?>

<div id="img-switch">
	<a href="javascript:void(0)" id="prev" class="off"><?= __('img_switch:prev'); ?></a>
	<p id="img-status"><?= __('img_switch:prefix').'1/'.($i-1); ?></p>
	<a href="javascript:void(0)" id="next"><?= __('img_switch:next'); ?></a>
</div>
<br class="clear" />

<div class="info txt">
	<?= Markdown($productData['Page']['txt_full']); ?>
</div>