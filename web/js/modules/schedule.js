$(document).ready(function () {
    $(document).on('click', '.week', function () {
        var t = $(this);
		$(location).attr('href','https://data.instatfootball.tv/views_custom/cabinet/web/schedule/week/'+$('#years').val()+'/'+t.data('week')+'/'+t.data('nweek'));
       
    });

    $(document).on('change', '#years', function () {
        var t = $(this);
        $(location).attr('href','https://data.instatfootball.tv/views_custom/cabinet/web/schedule/get_weeks/'+t.val());
    });

    $(document).on('click', '#hol1', function () {
        var t = $(this);
        $.post(
            '/views_custom/cabinet/web/schedule/holyday',
            {
                'week': t.data('week'),
				'type': $('#type').val(),
                'fio' : $('#fio').val()
            },
            function (data) {
                if (data == 'Ok') {
                    location.reload();
                } else {
                    alert(data);
                }
            },
            'json'
        );
    });
	
	$(document).on('click', '#hol2', function () {
        var t = $(this);
        $.post(
            '/views_custom/cabinet/web/schedule/holyday_del',
            {
                'hol_id': t.data('hol')
            },
            function (data) {
                if (data == 'Ok') {
                    location.reload();
                } else {
                    alert(data);
                }
            },
            'json'
        );
    });

    $(document).on('click', '.cells', function () {
        var t   = $(this);
		if (!t.hasClass('g') && !t.hasClass('r')) {
            var priz = t.parents('table').data('priz');
            var arr  = t.parent().data('curr_val').split(',');
            if (t.hasClass('selected') && !priz) {
                $.each(t.parent().find('td.cells'), function (key) {
                    $(this).html(arr[key]).removeClass('selected').removeClass('nselected');
                });
            } else {
                if (Number(t.text()) != 0) {
                    var inp = '';
                    if ($('#save').length) {
                        $.each(t.parent().find('td.cells'), function (key) {
                            $(this).html(arr[key]).removeClass('selected').removeClass('changed').addClass('nselected');
                        });
                        inp = t.parent().find('select').val();
                        if (inp != 0) {
                            t.html(inp + ' М');
                            t.removeClass('nselected').addClass('selected');
                            if ($('table').data('priz')) {
                                t.addClass('changed');
                            }
                        } else {
                            t.parent().find('td.cells').removeClass('selected').addClass('nselected');
                        }
                    }
                }
            }
        }
    });

    $(document).on('change', '.head table select', function () {
        var t = $(this);
        var arr = t.parents('tr').data('curr_val').split(',');
        $.each(t.parents('tr').find('td.cells'), function (key) {
            $(this).html(arr[key]).removeClass('selected').addClass('nselected');
        });
        t.parents('tr').find('td.cells').removeClass('selected, nselected');
        if (t.val() == 0){
            t.parents('tr').find('td.cells').addClass('nselected');
        }
    });

    $(document).on('click', '#save', function () {
        var t     = $(this);
		var priz  = $('table').data('priz');
        var summ  = 0;
        var check = true;
        var tr    = $('.head table').find('tr').slice(1);
        var arr   = tr.map(function () {
			if (priz) {
                var id;
                id    = $(this).data('day_id');
                day   = $(this).find('td:nth-child(1)').text().substr(0, 8);
                match = $(this).find('select').val();
                s     = $(this).find('.changed').data('s');
                if (match == 0 && id) {
					return id + ',' + day;
                } else if (s && match != 0) {
                    summ += Number(match);
                    return id + ',' + day + ',' + s + ',' + match;
                }
			} else {
				var day, match, s;
				day   = $(this).find('td:nth-child(1)').text().substr(0, 8);
				match = $(this).find('select').val();
				s     = $(this).find('.selected').data('s');
				if (match == 0) {

				} else if (s && match != 0) {
					summ += Number(match);
					return day + ',' + s + ',' + match;
				} else {
					check = false;
				}
			}
        });
		if (priz && !arr.length) {
            alert('Не внесено никаких изменений');
        }else if ((summ != t.data('m') && !priz) || (arr.length < t.data('d') && !priz)) {
            alert('Выбранное количество матчей / рабочих дней не соответствует нормам');
        } else {
            if (check) {
				var id   = $('#fio').val() ? $('#fio').val() : '';
                var type = $('#type').val();
                $.post(
                    '/views_custom/cabinet/web/schedule/save',
                    {
                        'week': $('.data').data('week'),
                        'arr' : arr.toArray().join(':'),
                        'type': type,
                        'id'  : id
                    },
                    function (data) {
                        if (data == 'Ok') {
                            $(location).attr('href', 'https://data.instatfootball.tv/views_custom/cabinet/web/schedule/week/' + $('#years').val() + '/' + $('.data').data('week') + '/' + $('.data').data('nweek') + '/' + type + '/' + id);
                        }else{
                            alert(data);
                        }
                    },
                    'json'
                );
            } else {
                alert('Выбраны не все слоты');
            }
        }
    });

    $(document).on('change', '#type', function () {
        var t = $(this);
        $(location).attr('href','https://data.instatfootball.tv/views_custom/cabinet/web/schedule/week/'+$('#years').val()+'/'+$('.data').data('week')+'/'+$('.data').data('nweek')+'/'+t.val() + '/' + $('#fio').val());
    })
	
	$(document).on('change', '#fio', function () {
        var t = $(this);
        $(location).attr('href','https://data.instatfootball.tv/views_custom/cabinet/web/schedule/week/'+$('#years').val()+'/'+$('.data').data('week')+'/'+$('.data').data('nweek') + '/' + (-1) + '/' + t.val());
    })
	
	$(document).on('click', '.r,.g', function () {
        var t = $(this);
		if (t.find('span').length) {
			$.post(
				'/views_custom/cabinet/web/schedule/modal',
				{
					'js': t.find('span').text()
				},
				function (data) {
					$('.modal-body').html(data).show();
					middle_position($('.modal-body'));
				},
				'html'
			);
		}
    });

    function middle_position(div) { //центрует блок по середине экрана
        var l = $(window).width() / 2;
        l -= div.width() / 2;
        var t = $(window).height() / 2;
        t -= div.height() / 2;
        div.css({
            'left': l,
            'top' : t
        });
    }

    $(document).mouseup(function (e) {
        var container = $(".modal-body");
        if (!container.is(e.target) && container.has(e.target).length === 0 && $('#ui-datepicker-div').has(e.target).length === 0) {
            container.removeAttr('style');
        }
    });
	
	 $(document).on('change', '#sel_week', function () {
        var t = $(this);
        var wkn = t.find('option:selected').data('wkn');
        var uri = t.parent().data('uri').split('/');
        $(location).attr('href', 'https://data.instatfootball.tv/'+uri[1]+'/'+uri[2]+'/'+uri[3]+'/'+uri[4]+'/'+uri[5]+'/'+uri[6]+'/'+t.val()+'/'+wkn);

    });
});