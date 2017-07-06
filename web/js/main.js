$(document).ready( function() {
	var openField = false;
	$('.headerLoop').click( function() {
		if(!openField) {
			$(this).parent(
				'.loop').children(
				'form').animate({
					'width': '70%'
				}, 300).children(
				'button');
			$('#searchform-q').css('padding', '5px');
		} else {
			$(this).parent(
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
       $.headerization = function(elem, child, child2, speed) {
           elem.hover( function() {
               child.fadeOut(speed*2)
               setTimeout( function() {
                   child2.fadeOut(speed)
               }, speed);
           }, function() {
               child2.fadeIn(speed*2)
               setTimeout( function() {
                   child.fadeIn(speed)
               }, speed);
           });

       }
    });
    var headerPic = $('.headerPic');
    $.headerization(headerPic, $('.header1'), $('.header2'), 500);
    headerPic.height($(this).width()*0.16);
});