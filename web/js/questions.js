$(document).ready( function() {
	var formhere = false;
	$('.questions > span').click( function() {
		if(!formhere) {
			$('.questForm').fadeIn('slow');
		} else {
			$('.questForm').fadeOut('slow');
		}
		formhere = !formhere;
	});
	var slideWidth = $('.overlay').width()/2;
	var currentSlide = 0;
	$('.halfForQuest').width(slideWidth);
	$('.questionsWrapper').width($('.halfForQuest').size()*$('.halfForQuest').width());
	$('.leftQuest').click( function() {
		if (currentSlide >= $('.halfForQuest').size() - 1) {
			$('.questionsWrapper').animate({'margin-left': 0}, 300);
			currentSlide = 0;
		} else {
			$('.questionsWrapper').animate({'margin-left': '-='+slideWidth}, 300);
			currentSlide += 1;
		}
	});
	$('.rightQuest').click( function() {
		if (currentSlide <= 0) {
			$('.questionsWrapper').animate({'margin-left': -slideWidth*($('.halfForQuest').size()-1)}, 300);
			currentSlide = $('.halfForQuest').size() - 1;
		} else {
			$('.questionsWrapper').animate({'margin-left': '+='+slideWidth}, 300);
			currentSlide -= 1;
		}
	});
	
	$('.sliderQuest').hover(function() {
		$('.questArrow').fadeIn('300');
	}, function() {
		$('.questArrow').fadeOut('300');
	});

    $('.moreAboutQuest').click( function() {
        $.ajax({
            url: 'question/view?id='+$(this).data('id'),
            dataType: 'html',
            error: function(xhr, textStatus) {
                $('#modalQuest > .modal-dialog > .modal-content > .modal-body').html([ xhr.status, textStatus ]);
            },
            success: function(data) {
                $('#modalQuest > .modal-dialog > .modal-content > .modal-body').html(data);
            }
        });
    });
});