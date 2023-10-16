<?php Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //Дата в прошлом
Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
Header("Pragma: no-cache"); // HTTP/1.1
Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Кабинет разборщика</title>

	<link rel="stylesheet" type="text/css" href="/css/style.css">

	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.js"></script>
	<!--	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/ru.js"></script>-->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

	<?php if (file_exists($css)){ ?>
		<link rel="stylesheet" type="text/css" href="<?='/'.$css?>">
	<?php } ?>

</head>
<body>
	<div class="container-fluid">
        <?php if ($_SERVER['REQUEST_URI'] != '/web/login'){ ?>
            <div class="row">
                <div class="col-xs-12">
                    <div>
                        <ul class="nav nav-tabs">
							<?php $url = explode('/', urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) ?>
                            <li <?php if ($_SERVER['REQUEST_URI'] == '/web/'){?>class="active"<?php } ?>><a href="/web/"><?= $this->text[1] ?></a></li>
                            <li <?php if (in_array('calculation', $url)){?>class="active"<?php } ?>><a href="/web/calculation"><?= $this->text[2] ?></a></li>
                            <li <?php if (in_array('rating', $url)){?>class="active"<?php } ?>><a href="/web/rating"><?= $this->text[9] ?></a></li>
                            <li <?php if (in_array('calculation2', $url)){?>class="active"<?php } ?>><a href="/web/calculation2"><?= $this->text[2].' 2.0' ?></a></li>
<!--                            <li --><?php //if (in_array('schedule', $url)){?><!--class="active"--><?php //} ?><!--<a href="/schedule">График</a></l>i>-->
<!--                            --><?php //if ($this->userinfo->role) {?>
<!--                            <li --><?php //if (in_array('options', $url)){?><!--class="active"--><?php //} ?><!--<a href="/options">Настройки</a></li>-->
<!--                            --><?php //} ?>
                        </ul>
                    </div>
                </div>
                <div style="position: absolute;right: 15px;top: 5px;">
					<?php
						$f = new \app\core\Model();
						$fr = $f->get_user_settings('flags');
						if ($fr){
							$this->lang = $fr->flag;
						}
                    ?>
                    <span id="flags"><img src="<?= '/images/flags/'.$this->flags->{$this->lang} ?>" alt=""></span>&nbsp;&nbsp;&nbsp;
                    <?php if (isset($fio['name'])){ ?>
                        <span><?= $fio['name'] ?></span>&nbsp;&nbsp;&nbsp;
                    <?php } ?>
                    <input type="button" id="exit" class="btn btn-default" value="<?= $this->text[8] ?>">
                </div>
            </div>
        <?php } ?>
		<?=$content?>
	</div>
<div class="loader"></div>
	<script src="/js/template.js"></script>
    <?php if (file_exists($js)){ ?>
        <script src="/<?=$js?>"></script>
    <?php } ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#exit', function () {
                $.post(
                    '/web/login',
                    {
                        'get': 'del_session'
                    },
                    function (data) {
                        if (data == 'ok'){
                            $(location).attr('href', '/web/');
                        }
                    },
                    'json'
                );
            });
        })
    </script>
</body>
</html>
