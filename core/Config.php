<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 08.03.2017
 * Time: 1:01
 */

namespace app\core;


use app\core\routing;

class Config
{
    public $userinfo;

    static function url()
    {
        $obj = new routing();
        return $obj->routing;
    }

    static function db()
    {
        $db = [
            'host' => 'localhost',
			'db'   => 'football_parser',
			'user' => 'root',
			'pass' => '',
			'charset' => 'utf8'
        ];
        return $db;
    }
}