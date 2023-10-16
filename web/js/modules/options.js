$(document).ready(function () {
    $(document).on('change', '#years', function () {
        var t = $(this);
        if (t.val() != 0) {
            $.post(
                '/web/options/get_weeks',
                {
                    'season_id': t.val()
                },
                function (data) {
                    if (data == 'error') {
                        alert('Error');
                    } else {
                        $('#weeks').html(data).change();
                    }
                },
                'html'
            );
        } else {
            $('.content').removeAttr('style');
        }
    });

    $(document).on('change', '#weeks', function () {
        var t = $(this);

        $.post(
            '/web/options/week',
            {
                'week': $('#weeks').val()
            },
            function (data) {
                if ($('#years').val()) {
                    $('.content').html(data);
                    $('.content').show();
                }
            },
            'html'
        );
    });

    $(document).on('click', '#save', function () {
        var t   = $(this);
        var opt = $('.opt').find('input').map(function () {
            return $(this).val()
        }).toArray();
		if (opt[4] > 7) {
            alert('Нельзя поставить норму дней > 7');
        }else{
			var t1  = $('.t1 tr').map(function () {
				var day, s1, s2, s3, s4, s5, id, worker_type = 1;
				id                                           = $(this).find('td:nth-child(1) input').data('id');
				day                                          = $(this).find('td:nth-child(1) input').val();
				s1                                           = $(this).find('td:nth-child(2) input').val();
				s2                                           = $(this).find('td:nth-child(3) input').val();
				s3                                           = $(this).find('td:nth-child(4) input').val();
				s4                                           = $(this).find('td:nth-child(5) input').val();
				s5                                           = $(this).find('td:nth-child(6) input').val();
				if (id) {
					return id + ',' + worker_type + ',' + day + ',' + s1 + ',' + s2 + ',' + s3 + ',' + s4 + ',' + s5;
				}
			}).toArray().join(':');
			var t2  = $('.t2 tr').map(function () {
				var day, s1, s2, s3, s4, s5, id, worker_type = 2;
				id                                           = $(this).find('td:nth-child(1) input').data('id');
				day                                          = $(this).find('td:nth-child(1) input').val();
				s1                                           = $(this).find('td:nth-child(2) input').val();
				s2                                           = $(this).find('td:nth-child(3) input').val();
				s3                                           = $(this).find('td:nth-child(4) input').val();
				s4                                           = $(this).find('td:nth-child(5) input').val();
				s5                                           = $(this).find('td:nth-child(6) input').val();
				if (id) {
					return id + ',' + worker_type + ',' + day + ',' + s1 + ',' + s2 + ',' + s3 + ',' + s4 + ',' + s5;
				}
			}).toArray().join(':');

			$.post(
				'/web/options/save',
				{
					'opt': opt.join(','),
					't1' : t1,
					't2' : t2
				},
				function (data) {
					if (data == 'Ok'){
						alert('Сохранено');
					}else {
						alert(data);
					}
				},
				'json'
			);
		}
    });
});
