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

    $( function() {
       $.headerization = function(elem, child, speed) {
           elem.hover( function() {child.fadeOut(speed)}, function() {child.fadeIn(speed)});
       }
    });
    var headerPic = $('.headerPic');
    $.headerization(headerPic, $('.header1'), 1000);

    headerPic.height($(this).width()*0.16);
});