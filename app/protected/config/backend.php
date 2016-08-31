<?php

// Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return CMap::mergeArray(

    require_once(dirname(__FILE__) . '/main.php'),

    array(
        // стандартный контроллер
        'defaultController' => 'admin/default',

        // компоненты
        'components' => array(
            'clientScript' => array(
                'coreScriptPosition' => CClientScript::POS_HEAD,
                'packages' => array(
                    'jquery' => array(
                        'baseUrl' => 'js/',
                        'js' => array(
                            'jquery-1.11.1.min.js',
                        ),
                    ),
                    'bootstrap3' => array(
                        'baseUrl' => '',
                        'js' => array(
                            'js/bootstrap.min.js',
                        ),
                        'css' => array(
                            'css/bootstrap.min.css',
                            'css/bootstrap-theme.min.css',
                        ),
                        'depends' => array('jquery'),
                    ),
                    'nested-sortable' => array(
                        'baseUrl' => 'js/',
                        'js' => array('jquery.mjs.nestedSortable.js'),
                        'depends' => array( 'jquery', 'jquery.ui' ),
                    ),
                    'admin-js' => array(
                        'baseUrl' => 'js/',
                        'js' => array(
                            'admin.js',
                        ),
                        'depends' =>array('jquery'),
                    ),
                    'admin-css' => array(
                        'baseUrl' => 'css/',
                        'css' => array('admin.css?css=' . time()),
                    ),
                ),
            ),

            // пользователь
            'user' => array(
                'class' => 'application.modules.user.components.WebUser',
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'loginUrl' => array('/user/login'),
            ),

            'image' => array(
                'class' => 'application.extensions.image.CImageComponent',
                'driver' => 'GD',
            ),
        ),
    )
);