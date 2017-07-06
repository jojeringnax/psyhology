$(document).ready( function() {
	var looppHeight = $('.libraryLoop').height();
	$('.libraryInput').height(looppHeight - 6);
	var clicked = false;

	$('span#A-Z').click( function() {

		$('.crest').click( function() {
			if(clicked) {
				$('span.opened').removeClass('opened').html('А - Я');
			}
			clicked = false;
		});

		if ($(this).hasClass('opened')) {
			clicked = false;
			return false;
		}

	
		$('span.opened').each (function() {
			$(this).removeClass('opened').html($(this).data('value'));
		});

		$(this).data('value', 'А');
		$(this).html('');
		$(this).append(
			'<div class="letterForm"><div class="crest">X</div><form id="letterForm" onsubmit="return false;" class="letter">\
			<select class="letterInput" maxlength="1" value="'+$(this).data('value')+'" style="width: 80%; margin: 0 auto; font-size:" list="tri" patter="[А-Яа-яЁё]" type="text" name="letter">\
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
		$('.letterInput').focus();
		$(this).addClass('opened');
		clicked = true;
		
		$('select.letterInput').on('input', function() {
			value = $(this).val();
			$('span.opened').data('value', value).html(value).removeClass('opened');
			$.ajax({
			url: 'library?letter='+letter,
			dataType: 'html',
			success: function(data) {
				$('.result').html(data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
		        alert(xhr.status);
		        alert(thrownError);
		    }
		});
			clicked = false;
		});

		var letter = $(this).data('value');

		
	});
});