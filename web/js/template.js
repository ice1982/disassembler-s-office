$(function () {
    $(document).on('click', '#flags', function () {
        var t    = $(this);
        var left = t.offset().left;
        var w    = t.outerWidth();
        var top  = t.offset().top;

        $.post(
            '/web/flags/get_flags_html',
            {},
            function (data) {
                $('#flags_list').remove();
                $('body').append(data);
                var wf = $('#flags_list').outerWidth();
                $('#flags_list').css({
                    'left': left + w - wf,
                    'top' : top + 22
                });
            },
            'html'
        );
    });

    out_click_close('#flags_list');

    $(document).on('click', '#flags_list span', function () {
        var t = $(this);

        $.post(
            '/web/flags/save_flag',
            {
                'flag': t.data('lang')
            },
            function (data) {
                if (data.status) {
                    location.reload();
                }
            },
            'json'
        );
    });

    function out_click_close(selector) {
        if (selector) {
            $(document).mouseup(function (e) {
                var container = $(selector);
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.remove();
                }
            });
        } else {
            console.log('insert selector in function out_click_close in quotes');
        }
    }
});