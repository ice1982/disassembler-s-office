<?php
return CMap::mergeArray(

    require_once(dirname(__FILE__) . '/main.php'),

    array(
        // стандартный контроллер
        'defaultController' => 'pages/default/view/',

        // компоненты
        'components' => array(

           'clientScript' => array(
                'coreScriptPosition' => CClientScript::POS_BEGIN,
                'packages' => array(
                    'jquery' => array(
                        'baseUrl' => 'js/',
                        'js' => array(
                            'jquery-1.11.1.min.js'
                        ),
                    ),
                    'bootstrap3' => array(
                        'baseUrl' => '',
                        'js' => array(
                            'js/bootstrap.min.js'
                        ),
                        'css' => array(
                            'css/bootstrap.min.css',
                            'css/bootstrap-theme.min.css',
                        ),
                        'depends' =>array('jquery'),
                    ),
                    'fancybox' => array(
                        'baseUrl' => '',
                        'js' => array(
                            // 'js/jquery.mousewheel-3.0.6.pack.js',
                            'js/jquery.fancybox.pack.js?v=2.1.5',
                            // 'js/jquery.fancybox-buttons.js?v=1.0.5',
                            // 'js/jquery.fancybox-media.js?v=1.0.6',
                            // 'js/jquery.fancybox-thumbs.js?v=1.0.7',
                        ),
                        'css' => array(
                            'css/jquery.fancybox.css?v=2.1.5',
                            // 'css/jquery.fancybox-thumbs.css?v=1.0.7',
                            // 'css/jquery.fancybox-buttons.css?v=1.0.5',
                        ),
                        'depends' => array('jquery'),
                    ),
                    'frontend-js' => array(
                        'baseUrl' => 'js/',
                        'js' => array(
                            'main.js',
                        ),
                        'depends' =>array('jquery'),
                    ),
                    'frontend-css' => array(
                        'baseUrl' => 'css/',
                        'css' => array('styles.css?css=' . time()),
                    ),
                ),
            ),

            'cache' => array(
                'class' => (YII_OS != 'WIN') ? 'CMemCache' : 'CDummyCache',
            ),
            'session' => array(
                'class' => 'CCacheHttpSession',
                'cacheID' => 'sessionCache',
            ),
            'sessionCache' => array(
                'class' => (YII_OS != 'WIN') ? 'CMemCache' : 'CDummyCache',
            ),

            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                // 'urlSuffix' => '/',
                'rules' => $_routes,
            ),
        ),
    )
);