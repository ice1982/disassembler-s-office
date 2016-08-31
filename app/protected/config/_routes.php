<?php

$_routes = array(
    array('sitemap/default/xml', 'pattern' => 'sitemap.xml', 'urlSuffix' => ''),
    array('sitemap/default/index', 'pattern' => 'sitemap', 'urlSuffix' => ''),

    '<module:(forms)>/<controller:(ajax)>/<action:\w+>' => '<module>/<controller>/<action>',

    // 'katalog-tovarov/search/*' => 'catalog/default/search',
    'katalog-tovarov/tovar/<id>' => array('catalog/default/view', 'id' => '<id>'),
    'katalog-tovarov/group/<id>' => array('catalog/default/group', 'id' => '<id>'),
    'katalog-tovarov/*' => 'catalog/default/index',

    'news/' => 'news/default/index',
    'news/<id>' => array('news/default/view', 'id' => '<id>'),


    // перенос путей для директа
    'flanczyi-izgotovlennyie-v-sootvetstvii-s-mezhdunarodnyimi-standartami-din-ans-asme' => 'catalog/default/index/group/65',
    'flanczyi-ploskie-stalnyie-privarnyie-gost-12820-80' => 'catalog/default/index/group/65',
    'flanczyi-stalnyie-privarnyie-vstyik-vorotnikovyie-gost-12821-80' => 'catalog/default/index/group/65',
    'flanczyi-svobodnyie-na-privarnom-kolcze-gost-12822-80' => 'catalog/default/index/group/65',
    'klapanyi' => 'catalog/default/index/group/12',
    'kranyi-sharovyie' => 'catalog/default/index/group/48',
    'otvodyi-krutoizognutyie' => 'catalog/default/index/group/65',
    'perexodyi' => 'catalog/default/index/group/65',
    'trojniki' => 'catalog/default/index/group/65',
    'ventili' => 'catalog/default/index/group/12',
    'ventili-iz-nerzhaveyushhej-stali' => 'catalog/default/index/group/12',
    'ventili-iz-stali' => 'catalog/default/index/group/12',
    'zadvizhki' => 'catalog/default/index/group/2',
    'zaglushki-flanczevyie' => 'catalog/default/index/group/65',
    'zatvoryi' => 'catalog/default/index/group/7',

    '<alias:[\w\-]+>' => array('pages/default/view/', 'alias'=>'<alias>'),
    '/' => array('pages/default/view/'),
);