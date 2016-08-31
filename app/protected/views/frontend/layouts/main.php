<!doctype html>

<!--[if lt IE 7]>
<html lang="ru" class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html lang="ru" class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html lang="ru" class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]>
<html lang="ru" class="no-js">
<![endif]-->


<!--[if !IE]><!--><html lang="ru" class="not-ie"><!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content='<?php echo CHtml::encode($this->pageDescription); ?>'>
    <meta name="keywords" content='<?php echo CHtml::encode($this->pageKeywords); ?>'>

    <meta name="google-site-verification" content="E-cr8gZJdvb6DBJUJMkA3dIhpu6i_ZXauEmAwjxNzzEY">
    <meta name='yandex-verification' content='4-2e08940108f30a5'>
    <meta http-equiv="Pragma" content="no-cache">

    <?php if ($this->pageIndex != 1) : ?>
    <meta name="robots" content="none">
    <?php endif; ?>

    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script src="/js/modernizr.custom.70918.js"></script>

    <?php if (!YII_DEBUG) : ?>
    <!-- <link rel="stylesheet" href="//cdn.callbackhunter.com/widget/tracker.css"> -->
    <!-- <script type="text/javascript" src="//cdn.callbackhunter.com/widget/tracker.js" charset="UTF-8"></script> -->
    <!-- <script type="text/javascript">var hunter_code="ff939e06f58306857ff4a47f63e4345d";</script> -->
    <!-- F1call code -->
    <script>
        (function() {
            var config = {
                API_BASE: 'http://connect.f1call.com',
                PROJECT_NAME: 'F1call',
            };

            if (typeof window[config.PROJECT_NAME] === 'undefined' && typeof CallPluginInitObject === 'undefined') {
                window['CallPluginInitObject'] = config;

                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = config.API_BASE + '/static/api.js';
                var x = document.getElementsByTagName('head')[0];
                x.appendChild(s);
            }
            else
                console.log(config.PROJECT_NAME + ' is already defined.');
        })();
    </script>
    <!-- F1call code end -->
    <?php endif;?>

    <?php Yii::app()->clientScript->registerPackage('jquery'); ?>
    <?php Yii::app()->clientScript->registerPackage('bootstrap3'); ?>
    <?php Yii::app()->clientScript->registerPackage('fancybox'); ?>
    <?php Yii::app()->clientScript->registerPackage('frontend-css'); ?>
    <?php Yii::app()->clientScript->registerPackage('frontend-js'); ?>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,300italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="/js/html5shiv.min.js"></script>
        <script src="/js/json2.min.js"></script>
        <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <?php if (!YII_DEBUG) : ?>
    <!-- Google.Analytics counter -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-22832049-2']);
        _gaq.push(['_setDomainName', 'bristol-msk.ru']);

        _gaq.push(['_addOrganic', 'images.google.ru', 'q', true]);
        _gaq.push(['_addOrganic', 'images.yandex.ru', 'text', true]);
        _gaq.push(['_addOrganic', 'blogs.yandex.ru', 'text', true]);
        _gaq.push(['_addOrganic', 'blogsearch.google.ru', 'q', true]);
        _gaq.push(['_addOrganic', 'go.mail.ru', 'q']);
        _gaq.push(['_addOrganic', 'win.mail.ru', 'q']);
        _gaq.push(['_addOrganic', 'gogo.ru', 'q']);
        _gaq.push(['_addOrganic', 'nova.rambler.ru', 'query']);
        _gaq.push(['_addOrganic', 'nigma.ru', 's']);
        _gaq.push(['_addOrganic', 'google.com.ua', 'q']);
        _gaq.push(['_addOrganic', 'search.qip.ru', 'query']);
        _gaq.push(['_addOrganic', 'ru.yahoo.com', 'p']);
        _gaq.push(['_addOrganic', 'poisk.ru', 'text']);
        _gaq.push(['_addOrganic', 'aport.ru', 'r']);

        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <!-- /Google.Analytics counter -->
    <?php endif;?>

    <?php if (!YII_DEBUG) : ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter12157801 = new Ya.Metrika({id:12157801, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/12157801" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <?php endif;?>




    <?php echo $content; ?>


    <?php
        foreach ($this->buffer as $buffer) {
            echo $buffer;
        }
    ?>

    <?php if (!YII_DEBUG) : ?>


    <?php
     // <!-- BEGIN JIVOSITE CODE {literal} -->
    // <script type="text/javascript">
     //   (function() { var widget_id = '15112';
      //      var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss); })(); </script>
    //<!-- {/literal} END JIVOSITE CODE -->
    ?>

    <!-- BEGIN JIVOSITE CODE {literal} -->
    <script type='text/javascript'>
        (function(){ var widget_id = 'qMUpkPJMZS';var d=document;var w=window;function l(){
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
    <!-- {/literal} END JIVOSITE CODE -->

    <?php endif;?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="/js/ie10-viewport-bug-workaround.js"></script>

</body>



</html>

