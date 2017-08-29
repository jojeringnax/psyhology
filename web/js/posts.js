$(document).ready( function() {
	var colors = [
	 //'#079', //darkblue
	 '#59a', //lightblue
     '#da5', //lightorange
     '#9ba', //lightgreen
     //'#da8800', //brighrorange
     //'#865', //brown-ish
     '#b9967a', //lightbrown
     //'#367' //darkblue-ish
    ];
    $(function() {
		$.colorification = function() {
            $('.postContent').each( function() {
                $(this).height(104 - $(this).parent('.post').children('.postTitle').height());
            });
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
					$(this).html('<img class="postTypeImg" src="/img/pic/' + $(this).data('type') + '.png" \/>');
				});
			});
			var postImg = $('.postImg');
			var postImgImg = $('.postImg > img');
			postImgImg.css('margin-top' , (postImg.height() - postImgImg.width())/2);
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


});