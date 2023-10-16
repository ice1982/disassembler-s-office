$('.sticky-column, .sticky-column-title').each(function () {
	$(window).scrollLeft(0);
	$(this).css('left', $(this).offset().left);
});

$(document).on('click', '.points', function () {
	$.post(
		'/web/calculation2/get_points',
		{
			'person': $(this).data('person'),
			'from'  : $(this).data('from'),
			'to'    : $(this).data('to'),
		},
		function (data){
			$('#points_modal').html(data);
		},
		'html'
	);
});