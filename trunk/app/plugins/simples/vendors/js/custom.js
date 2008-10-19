var SIMPLES = {};

/**
 * Activate page language form.
 */
jQuery(document).ready(function($) {
	$('#pageLanguage').bind('change', function(e) {
		$(this).parents('form').submit();
	});
});

/**
 * Activate live search.
 */
jQuery(document).ready(function($) {
	$('#search').bind('keyup', function(e) {
		if (e.which == 27) {
			$(this).val('');
		}
		SIMPLES.liveSearch(this.value);
	});
});

/**
 * Live search request.
 */
SIMPLES.liveSearch = function(query) {
	var baseUrl = $('#baseurl').val();
	
	jQuery.ajax({
		type: 'POST',
		cache: false,
		url: baseUrl + '/search',
		data: 'query=' + query,
		success: function(response) {
			$('#list').html(response);
		}
	});
}

/**
 * Validate add form.
 */
jQuery(document).ready(function($) {
	$('#add').parents('form').bind('submit', function(e) {
		var addValue = $('#add').attr('value');
			addValue = addValue.replace(/ /gi, '');
		
		if (addValue == '') {
			$('#add').val('');
			$('#add').parent().children('p').removeClass('hide');
			$('#add').parent().children('input.submit').blur();
			return false;
		} else {
			$('#add').parent().children('p').addClass('hide');
			return true;
		}
	});
});

/**
 * Activate checkboxes.
 */
jQuery(document).ready(function($) {
	/* Toogle all checkboxes at once */
	$('#checkall').checkgroup({groupName:'group'});
	
	/* Toogle del button */
	$('#checkall').livequery('click', function(e) {
		SIMPLES.toogleDelButton();
	});
	$('input[name="group"]').livequery('click', function(e) {
		SIMPLES.toogleDelButton();
	});
	
	/* Activate del button */
	var controller = $('#list').attr('class');
	
	$('#del').click(function(event) {
		var checkBoxes = new Array();
		var baseUrl = $('#baseurl').val();
		
		$('input[name="group"]:checked').each(function(i){
			checkBoxes[i] = $(this).val();
		});
		
    	$.ajax({
			type: 'POST',
			cache: false,
			url: baseUrl + '/del',
			data: 'items=' + checkBoxes,
			success: function(response) {
				/* Output list */
				$('#list').html(response);
				
				/* Uncheck checkall */
				$('#checkall').attr('checked', false);
				
				/* Toogle and blur del button */
				SIMPLES.toogleDelButton();
				$('#del').blur();
				
				/* Clear search */
				$('#search').val('');
			}
		});
	});
});

/**
 * Toggle (enable/disable) del button.
 */
SIMPLES.toogleDelButton = function() {
	if ($('input[name="group"]:checked').length == 0) {
		$('#del').attr('disabled', 'disabled').addClass('off');
	} else {
		$('#del').attr('disabled', false).removeClass('off');
	}
};

/**
 * Activate move up/down for menus.
 */
jQuery(document).ready(function($) {
	$('.move').livequery('click', function(event) {
		var url = $(this).attr('href');
		
		$.ajax({
			type: 'POST',
			cache: false,
			url: url,
			success: function(response) {
				$('#list').html(response);
			}
		});
		
		event.preventDefault();
	})
});

/**
 * Activate publish/unpublish for menus.
 */
jQuery(document).ready(function($) {
	$('.publish').livequery('click', function(event) {
		var url = $(this).attr('href');
		
		$.ajax({
			type: 'POST',
			cache: false,
			url: url,
			success: function(response) {
				$('#list').html(response);
			}
		});
		
		event.preventDefault();
	})
});
