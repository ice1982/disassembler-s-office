<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/../main.php'),
    array(
        'components'=>array(
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=bristolmsk_v3yii',
                'emulatePrepare' => true,
                'username' => 'bristolmsk_v3yii',
                'password' => '2H5d6W4t',
                'charset' => 'utf8',
                'tablePrefix' => '',
                'schemaCachingDuration' => 180,
            ),
//             'log' => array(
//                 'class'=>'CLogRouter',
//                 'routes'=>array(
//                     array(
//                         'class' => 'CEmailLogRoute',
// //                        'categories' => 'errors',
//                         'levels' => CLogger::LEVEL_ERROR,
//                         'emails' => array('pv.danilov.dev@yandex.ru'),
//                         'sentFrom' => 'log@bristol-msk.ru',
//                         'subject' => 'Критическая ошибка на сайте www.bristol-msk.ru',
//                     ),
//                     array(
//                         'class' => 'CEmailLogRoute',
// //                        'categories' => 'warnings',
//                         'levels' => CLogger::LEVEL_WARNING,
//                         'emails' => array('pv.danilov.dev@yandex.ru'),
//                         'sentFrom' => 'log@bristol-msk.ru',
//                         'subject' => 'Ошибка на сайте www.bristol-msk.ru',
//                     ),
//                 ),
//             ),
        ),
        'modules' => array(
            // uncomment the following to enable the Gii tool
            'gii' => array(),
        ),
    )
);

?>