<?php

require_once(dirname(__FILE__) . '/_about.php');
require_once(dirname(__FILE__) . '/_routes.php');
require_once(dirname(__FILE__) . '/_params.php');

return array(

	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => $_about['project'],
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',

    // preloading 'log' component
    'preload' => array('log'),

    'import' => array(
        'application.modules.core.behaviors.*',
        'application.modules.core.components.base.*',
        'application.modules.core.components.controllers.*',
        'application.modules.core.components.actions.*',

        'application.vendors.*',
    ),

	// используемые приложением поведения
	'behaviors' => array(
        'runEnd' => array(
            'class' => 'application.modules.core.behaviors.WebApplicationEndBehavior',
        ),
    ),

	// application components
	'components' => array(
		// 'errorHandler' => array(
		// 	'errorAction' => 'core/core/error',
		// ),
        'log' => array(
            'class'=>'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),

        'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host' => "smtp.gmail.com",
            'Username' => 'citrus.plus.smtp@gmail.com',
            'Password' => '53JzNYvKyV5M',
            'Mailer' => 'smtp',
            'Port' => 465,
            'SMTPAuth'=>true,
        ),
	),

    'modules' => array(
        'core',
        'admin',
        'catalog',
        'gallery',
        'pages',
        'news',
        'blocks',
        'forms',
        'sitemap',
        'utm',
        'user' => array(
            # encrypting method (php hash function)
            'hash' => 'sha1',

            # send activation email
            'sendActivationMail' => true,

            # allow access for non-activated users
            'loginNotActiv' => false,

            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,

            # automatically login from registration
            'autoLogin' => true,

            # registration path
            // 'registrationUrl' => array('/user/registration'),

            # recovery password path
            'recoveryUrl' => array('/user/recovery'),

            # login form path
            'loginUrl' => array('/user/login'),

            # page after login
            'returnUrl' => array('/admin/'),

            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
    ),

	'params' => $_params,


);