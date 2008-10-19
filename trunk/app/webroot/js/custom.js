document.observe('dom:loaded', function()
{
	activateTooltips();
	activateImageSwitch();
	activateSubmenu();
});

function activateTooltips()
{
	if ($('tooltip1'))
	{
		var tooltips = $$('.tooltip');
		var allTooltips = new Array();
		
		for (var i=1; i<=tooltips.length; i++)
		{
			allTooltips[i] = new Tooltip('product'+i, 'tooltip'+i);
		}
	}
}

function activateImageSwitch()
{
	if ($('img-switch') && $('image2'))
	{
		$('img-switch').addClassName('show');
		
		$('prev').observe('click', function()
		{
			if (!$('prev').hasClassName('off')) { switchImages('prev'); }
			checkImageButtons();
	  });
	  
	  $('next').observe('click', function()
		{
			if (!$('next').hasClassName('off')) { switchImages('next'); }
			checkImageButtons();
	  });
	}
}

function switchImages(move)
{
	if (move == 'prev') { $('img-now').value = parseInt($('img-now').value)-1; }
	else if (move == 'next') { $('img-now').value = parseInt($('img-now').value)+1; }
	
	var imgNow = parseInt($('img-now').value);
	var imgCount = parseInt($('img-count').value);
	var imgPrefix = $('img-status').innerHTML.split(':');
	
	$('img-status').firstChild.nodeValue = imgPrefix[0] + ': ' + imgNow + '/' + imgCount;
	
	for (var i=1; i<=imgCount; i++)
	{
		if (i == imgNow) { $('image'+i).removeClassName('hide'); }
		else { $('image'+i).addClassName('hide'); }
	}
}

function checkImageButtons()
{
	if (parseInt($('img-now').value) == 1) { $('prev').addClassName('off'); $('next').removeClassName('off'); }
	else if (parseInt($('img-now').value) == parseInt($('img-count').value)) { $('prev').removeClassName('off'); $('next').addClassName('off'); }
	else { $('prev').removeClassName('off'); $('next').removeClassName('off'); }
}

function activateSubmenu()
{
	if ($('submenu'))
	{
		$('submenu-btn').hide();
		
		$('submenu').observe('change', function()
		{
			var baseLocation = $('submenu-form').action;
			var newLocation = baseLocation + '/' + $('submenu').options[$('submenu').selectedIndex].value;
			
			location.href = newLocation;
	  });
	}
}