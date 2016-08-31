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

    <meta name="robots" content="none">

    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon" href="/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/touch-icon-ipad-retina.png">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script src="/js/modernizr.custom.70918.js"></script>

    <?php Yii::app()->clientScript->registerPackage('jquery'); ?>
    <?php Yii::app()->clientScript->registerPackage('bootstrap3'); ?>
    <?php Yii::app()->clientScript->registerPackage('admin-js'); ?>
    <?php Yii::app()->clientScript->registerPackage('admin-css'); ?>

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

    <?php echo $content; ?>



    <!-- TinyMCE -->
    <script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            cleanup : false,
            content_css : "<?=Yii::app()->getBaseUrl(true)?>/css/bootstrap.min.css, <?=Yii::app()->getBaseUrl(true)?>/css/styles.css",
            convert_urls : false,
            editor_selector : "tinymce",
            editor_deselector : "no-tinymce",
            extended_valid_elements : "object[width|height|classid|codebase|embed|param],param[name|value],embed[param|src|type|width|height|flashvars|wmode],div[*],p[*],script[type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder]",
            media_strict: false,
            mode : "specific_textareas",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "textcolor",
                "insertdatetime media table contextmenu paste jbimages"
            ],
            style_formats: [
                {title: "Заголовки", items: [
                    {title: "Заголовок 1", classes: "font-h1"},
                    {title: "Заголовок 2", classes: "font-h2"},
                    {title: "Заголовок 3", classes: "font-h3"},
                    {title: "Заголовок 4", classes: "font-h4"}
                ]},
                {title: "Шрифт", items: [
                    {title: 'Фирменный шрифт', inline: 'span', classes: 'font'},
                    {title: "Жирный", icon: "bold", format: "bold"},
                    {title: "Курсив", icon: "italic", format: "italic"},
                    {title: "Подчеркнутый", icon: "underline", format: "underline"},
                    {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
                    {title: "Superscript", icon: "superscript", format: "superscript"},
                    {title: "Subscript", icon: "subscript", format: "subscript"},
                    {title: "Code", icon: "code", format: "code"}
                ]},
                {title: "Blocks", items: [
                    {title: "Paragraph", format: "p"},
                    {title: "Blockquote", format: "blockquote"},
                    {title: "Div", format: "div"},
                    {title: "Pre", format: "pre"}
                ]},
                {title: "Alignment", items: [
                    {title: "Left", icon: "alignleft", format: "alignleft"},
                    {title: "Center", icon: "aligncenter", format: "aligncenter"},
                    {title: "Right", icon: "alignright", format: "alignright"},
                    {title: "Justify", icon: "alignjustify", format: "alignjustify"}
                ]},
            ],
            toolbar: "insertfile undo redo | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | code",
            toolbar2: "fontselect emoticons",
            relative_urls : false,
            valid_elements : '*[*]',
            theme: "modern"
        });
    </script>
    <!-- /TinyMCE -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="/js/ie10-viewport-bug-workaround.js"></script>

</body>



</html>

