$(document).ready( function() {
	var colors = ['#079', '#59a', '#da5', '#9ba', '#da8800', '#865', '#b9967a', '#367'];
	$('.postImg.img').height($('.small').width());
	$(function() {
		$.colorification = function() {
			$('.post').each( function() {
				var color = colors[Math.floor(Math.random()*colors.length)]
				$(this).css({
					'background-color': color,
					'border': '4px solid ' + color});
				color = $(this).css('background-color');
				$(this).hover( function() {
					$(this).css('background-color', 'white');
					$(this).children('.postContent').css('color', 'black');
				}, function() {
					$(this).css('background-color', color);
					$(this).children('.postContent').css('color', 'white');
				});
				$(this).children('.newTypeWrapper').children('.postType').each( function() {
					$(this).html('<img class="postTypeImg" src="img/pic/' + $(this).data('type') + '.png" \/>');
				});
			});
		}
	});

	$.colorification();

	$('.postImg').click( function() {
		$.colorification();
	});	

	$('.specialDay').each( function() {
		var aDay = $(this);
		aDay.hover( function() {
			$(this).children('.b-calendar__number').children('.description').fadeIn('slow');
		}, function() {
			$(this).children('.b-calendar__number').children('.description').fadeOut('slow');
		});
	});
	$('.description').each(function() {
		$(this).css('top', $(this).data('margin')*20 + 'px');
	});
	$('.postContent').each( function() {
		$(this).height(104 - $(this).parent('.post').children('.postTitle').height());
	});
});