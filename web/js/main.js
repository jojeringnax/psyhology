$(document).ready( function() {
	var openField = false;
	$('.headerLoop').click( function() {
		if(!openField) {
			$(this).animate({'width': '7.5%', 'margin-top': '5px'}, 300).parent(
				'.loop').children(
				'form').animate({
					'width': '70%'
				}, 300).children(
				'button').css(
				'background', 'url("/img/pic/search.png") right top / contain no-repeat');
			$('#searchform-q').css('padding', '5px');
		} else {
			$(this).animate({'width': '10%'}, 300).parent(
				'.loop').children(
				'form').animate({
					'width': '0px'
				}, 300).children(
				'button').css(
				'background', 'none');
			$('#searchform-q').css('padding', '5px 0 5px 0');
		}
		openField = !openField;
	});

	$('.headerPic').hover( function() {
		$(this).children('.header1').fadeOut('1000');
		$.setTimeout( function() {
			$(this).children('.header2').fadeOut('1000')
		}, '1000');
	}, function() {
		$(this).children('.header2').fadeIn('300');
		$.setTimeout( function() {
			$(this).children('.header1').fadeIn('300')
		}, '300');
	}).height($(this).width()*0.16);
});