$(document).ready( function() {
	var clicked = false;

	$('span#A-Z').click( function() {
		$(this).data('value', 'А - Я');
		var type = $(this).data('type');

		if ($(this).hasClass('opened')) {
			clicked = false;
			return false;
		}

	
		$('span.opened').each (function() {
			$(this).removeClass('opened').html($(this).data('value'));
		});
		$(this).html('');
		$(this).append(
			'<div class="letterForm"><form id="letterForm" onsubmit="return false;">\
			<select class="letterInput" maxlength="1" value="'+$(this).data('value')+'" style="width: 80%; margin: 0 auto; font-size:" list="tri" patter="[А-Яа-яЁё]" type="text" name="letter">\
			    <option>А - Я</option>\
			    <option>А</option>\
			    <option>Б</option>\
			    <option>В</option>\
			    <option>Г</option>\
			    <option>Д</option>\
			    <option>Е</option>\
			    <option>Ж</option>\
			    <option>З</option>\
			    <option>И</option>\
			    <option>Й</option>\
			    <option>К</option>\
			    <option>Л</option>\
			    <option>М</option>\
			    <option>Н</option>\
			    <option>О</option>\
			    <option>П</option>\
			    <option>Р</option>\
			    <option>С</option>\
			    <option>Т</option>\
			    <option>У</option>\
			    <option>Ф</option>\
			    <option>Х</option>\
			    <option>Ц</option>\
			    <option>Ш</option>\
			    <option>Щ</option>\
			    <option>Э</option>\
			    <option>Ю</option>\
			    <option>Я</option>\
			  </select>\
			<input style="display: none;" type="submit" /></form></div>'
			);
		$(this).addClass('opened');
		clicked = true;
		
		$('select.letterInput').on('input', function() {
			value = $(this).val();

			$('span.opened').data('value', value).html(value).removeClass('opened').addClass('choosen');

			$.ajax({
				url: 'library',
				data: {'letter': value, 'type': type},
				dataType: 'html',
				success: function(data) {
					var choosenSpan = $('span.choosen');
					var choosenSpanLibrary = choosenSpan.parent('.library');
					choosenSpanLibrary.append('<div class="resultLibrary"></div>');
					var choosenSpanLibraryResult = choosenSpanLibrary.children('.resultLibrary');
					choosenSpanLibraryResult.css('display', 'block').html('<button type="button" class="close" style="margin-right: 5px;">×</button>'+data);
					choosenSpan.removeClass('choosen');
					choosenSpanLibraryResult.children('.close').click( function() {
						choosenSpanLibraryResult.css('display', 'none');
					});
				},
				error: function (xhr, ajaxOptions, thrownError) {
			        alert(xhr.status);
			        alert(thrownError);
			    }
			});
			clicked = false;
		});

		
	});
});