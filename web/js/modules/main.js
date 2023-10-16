$(document).ready(function (){


    $(window).on('scroll', function () {
        if ($('.head').position() && $('.head').position().left) {
            var left = $('.head').position().left;
            left = -this.scrollX + 15;
            $('.head').css('left', left + 'px');
        }
    });

    $(document).on('click', '.cp', function () {
        $('.tab2').empty();
		var text = get_text('text');
        $.post(
            '/web/main/getdata',
            {
                'get': 'by_day',
                'id': $(this).data('id'),
                'date': $(this).data('date')
            },
            function (data) {
                if (data == 'sel'){
                    location.reload();
                }else {
                    $('.tab2').append("<div>"+text[19]+"</div><br>" +
                        "<div class='a_c_m_b_m'>" +
                        "<div class='a_c_m_b_in'><b>"+text[20]+"</b></div>" +
                        "<div class='a_c_m_b_in'><b>"+text[21]+"</b></div>" +
                        "<div class='a_c_m_b_in'><b>"+text[41]+"</b></div>" +
                        "<div class='a_c_m_b_in'><b>"+text[22]+"</b></div>" +
                        "<div class='a_c_m_b_in'><b>"+text[43]+"</b></div>" +
                        "<div class='a_c_m_b_in'><b>"+text[23]+"</b></div>" +
                        "<div class='a_c_m_b_in'><b>"+text[27]+"</b></div>" +
                        "<div class='a_c_m_b_in'><b>"+text[42]+"</b></div>" +
                        "</div><div style='clear: both'></div><hr>");
                    $.each(data['data'], function () {
                        var at;
                        if (this.analysis_type) at = this.analysis_type; else at = '';
                        if (this['analysis'] == 1) {
                            $('.tab2').append("<div class='a_c_m_b_m' style='color: #00bf00'>" +
                                "<div class='a_c_m_b_in'>" + this.sports + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.MATCH_ID + "</div><div class='a_c_m_b_in'>" + this.MATCH_NAME_ENG + "</div>" +
                                "<div class='a_c_m_b_in'>" + at + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.QUANT_M + "</div><div class='a_c_m_b_in'>" + this.PART_OF + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.MISTAKES + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.TIME_E.substr(0, 10) + "</div>" +
                                "</div><hr>");
                        } else if (this['analysis'] == 2) {
                            $('.tab2').append("<div class='a_c_m_b_m' style='color: deepskyblue'>" +
                                "<div class='a_c_m_b_in'>" + this.sports + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.MATCH_ID + "</div><div class='a_c_m_b_in'>" + this.MATCH_NAME_ENG + "</div>" +
                                "<div class='a_c_m_b_in'>" + at + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.QUANT_M + "</div><div class='a_c_m_b_in'>" + this.PART_OF + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.MISTAKES + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.TIME_E.substr(0, 10) + "</div>" +
                                "</div><hr>");
                        } else {
                            $('.tab2').append("<div class='a_c_m_b_m' style='color: black'>" +
                                "<div class='a_c_m_b_in'>" + this.sports + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.MATCH_ID + "</div><div class='a_c_m_b_in'>" + this.MATCH_NAME_ENG + "</div>" +
                                "<div class='a_c_m_b_in'>" + at + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.QUANT_M + "</div><div class='a_c_m_b_in'>" + this.PART_OF + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.MISTAKES + "</div>" +
                                "<div class='a_c_m_b_in'>" + this.TIME_E.substr(0, 10) + "</div>" +
                                "</div><hr>");
                        }
                    });
                    if (data['additional']) {
                        $('.tab2').append("<br><br>");
                        $('.tab2').append("<div>"+text[28]+"</div><br>" +
                            "<div class='a_c_m_b_o'>" +
                            "<div class='a_c_m_b_in'><b>Событие</b></div>" +
                            "<div class='a_c_m_b_in'><b>"+text[38]+"</b></div>" +
                            "<div class='a_c_m_b_in'><b>"+text[39]+"</b></div>" +
                            "<div class='a_c_m_b_in'><b>"+text[40]+"</b></div>" +
                            "</div><hr>");
                    }
                    $.each(data['additional'], function () {
                        $('.tab2').append("<div class='a_c_m_b_o'>" +
                            "<div class='a_c_m_b_in'>" + this['action'] + "</div><div class='a_c_m_b_in'>" + this['quantity'] + "</div>" +
                            "<div class='a_c_m_b_in'>" + this['size'] + "</div><div class='a_c_m_b_in'>" + this['comment'] + "</div>" +
                            "</div>");
                    });
                }
            },
            'json'
        );
        $('#myModal').modal();
    });

    $('.datetimepicker').datetimepicker({
        locale: get_text('lang'),
        format: 'DD-MM-Y'
    });

    $(document).on('click', '.btn-primary', function () {
        if ($('#begin').val() != '' && $('#end').val() != '') {
            $('body').css('background', 'url("images/ajax-loader.gif") no-repeat fixed center');
        }else{
            alert("Заполните даты");
            return false;
        }
        var button = $(this);
        $('.tab1').empty();
        $.post(
            '/web/main/getdata',
            {
                'get': 'period',
                'career': $('select[name="career"]').val(),
                'begin': $('input[name="begin"]').val(),
                'end': $('input[name="end"]').val()
            },
            function (data) {
                $('body').css('background', 'url("images/ajax-loader.gif") no-repeat fixed center');
                var dates = data.dates;
				var text     = get_text('text');
                var datas = data.datas;
                var category = data.category;
                var d_begin = $('input[name="begin"]').val().split("-");
                var summ = 0;
                var tr = 0;
                $('.tab1').append("<tr class='head' style='left: 15px;'><th class='th fio'></th><th class='th p'></th></tr>");
                $.each(dates, function () {
                    var date = this.d;
                    var date_e = '';
                    var dev_date = date.split('-');
                    $('.head').append("<th class='th gen'>"+dev_date[2]+"<br>"+dev_date[1]+"</th>");

                    $.each(category, function () {
                        $.each(this, function () {
                            var devdate_e = this.date_e.split('-');
                            var devdate_b = this.date_b.split('-');
                            if (date == this.date_e){
                                if ($('.head th.w:first').length) {
                                    $('.head').append("<th class='th gen w'>" + devdate_b[2] + "-" + devdate_b[1] + "<br>" + devdate_e[2] + "-" + devdate_e[1] + "</th>");
                                }else{
                                    $('.head').append("<th class='th gen w'>"+d_begin[0]+"-"+d_begin[1]+"<br>"+devdate_e[2]+"-"+devdate_e[1]+"</th>");
                                }
                            }
                        });
                        return false;
                    });
                });
                $.each(datas, function (e) {
                    var item = this;
                    var end_count = dates.length;
                    var count = 0;
                    $('.tab1').append("<tr class='body'><td class='td fio'></td><td class='td p'></td></tr>");
                    $.each(dates, function () {
                        var date = this.d;
                        var dat = item[date] ? item[date] : 0;
                        if (category[e] && category[e].length) {
                            var catlen = category[e].length;
                        }
                        var part_of = dat.part_of;
                        if (dat){
                            var fio = dat.fio.split(' ');
                            $('.body:last td:first').html(fio[0]+" "+fio[1]+"<br>"+fio[2]);
                        }
                        if (dat.name_ru != undefined) {
                            var rez_name = dat.name_ru.split(',');
                            var rez_name1 = rez_name[0].split(' ');
                            var first_letter = rez_name1[0].substr(0, 1);
                            if (rez_name1[1] != undefined) {
                                first_letter += rez_name1[1].substr(0, 1);
                            }
                            if (rez_name1[2] != undefined) {
                                first_letter += rez_name1[2].substr(0, 1);
                            }
                            if (rez_name[1] != undefined) {
                                first_letter += ', '+rez_name[1].substr(1, 1);
                            }
                        }
                        $('.body:last td:nth-child(2)').text(first_letter);
                        $.each(category[e], function () {
                            catlen--;
                            if (dat && this.date_b <= date && date <= this.date_e){
                                $('.body:last').append("<td class='td cp gen' data-id='"+e+"' data-date='"+date+"'>"+Number(part_of).toFixed(3)+"<br><div class='cat'>"+this.cat_bef+"</div></td>");
                                if(dat.reason){
                                    var reason = dat.reason;
                                    if ($.inArray('5', reason) != -1) {
                                        $('td:last').css('background', 'yellow');
                                    }else if ($.inArray('6', reason) != -1){
                                        $('td:last').css('background', 'red');
                                    }else if ($.inArray('7', reason) != -1){
                                        $('td:last').css('background', 'green');
                                    }else if ($.inArray('18', reason) != -1) {
                                        $('td:last').css('background', '#FF69B4');
                                    }
                                    if (reason.length == 1 && reason[0] >= 10 && reason[0] <= 17 ||  reason.length > 1){
                                        $('td:last').append("<div class='other'></div>");
                                    }
                                }
                                summ = summ + Number(part_of);
                                tr = 1;
                                if (date == this.date_e){
                                    $('.body:last-child').append("<td class='td cp gen w' data-id='"+e+"' data-date='"+this.date_b+","+this.date_e+"'>"+summ.toFixed(3)+"</td>");
                                    summ = 0;
                                    tr = 0;
                                }
                                return false;
                            }else {
                                if (!catlen || date == this.date_e){
                                    $('.body:last').append("<td class='td gen' data-date='"+date+"'></td>");
                                    tr = 1;
                                }
                                if (date == this.date_e){
                                    $('.body:last').append("<td class='td cp gen w' data-id='"+e+"' data-date='"+this.date_b+","+this.date_e+"'>"+summ.toFixed(3)+"</td>");
                                    summ = 0;
                                    tr = 0;
                                    return false;
                                }
                            }
                        });
                        count++;
                        if (count == end_count && tr){
                            $('.body:last').append("<td class='td gen cp e' data-id='"+e+"'>" + summ.toFixed(3) + "</td>");
                            var first = $('td:last').siblings('.w:last').next().data('date');
                            if (first) {
                                $('td:last').attr('data-date', (first + ',' + date));
                            }else {
                                first = $('td:first').data('date');
                                $('td:last').attr('data-date', (first + ',' + date));
                            }
                        }
                        if (count == end_count){
                            var s = 0;
                            $.each($('.body:last').children('.w,.e'), function () {
                                s += Number($(this).html());
                            });
                            $('.body:last').append("<td class='td gen i'>"+s.toFixed(3)+"</td>");
                            summ = 0;
                        }
                    });
                });

                if (tr) {
                    $('.head').append("<th class='th gen w'></th>");
                    var first = $('th:last').siblings('.w:last').next().html();
                    var second = $('th:last').prev().html().split("<br>");
                    if (first) {
                        first = first.split("<br>");
                        $('th:last').html(first[0] + "-" + first[1] + "<br>" + second[0] + "-" + second[1]);
                    }else{
                        first = $('th:nth-child(3)').html().split("<br>");
                        $('th:last').html(first[0] + "-" + first[1] + "<br>" + second[0] + "-" + second[1]);
                    }

                }
                $('.head').append("<th class='th gen i'>" + text[7] + "</th>");
                $('body').removeAttr('style');
            },
            'json'
        );
    });

    ibPositionR = function(t) {
        var off = t.offset();
        t.show();
        var ot = off.top + 26; //35;
        var ol = off.left - 200;
        var rb = $(window).width() + $(window).scrollLeft();
        if(ol + 560 >= rb) ol = rb - 565;
        t.offset({top:ot, left:ol});
    }

	function get_text(opt) {
        var text;
        var lang;
        $.ajax({
            type    : 'post',
            url     : '/web/main/get_text',
            success : function (data) {
                text = data.text;
                lang = data.lang;
            },
            dataType: 'json',
            async   : false
        });
        if (opt == 'lang'){
            return lang;
        } else {
            return text;
        }
    }
});