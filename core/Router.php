<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 23:01
 */

namespace app\core;


class Router
{
	public $test = 'test';

	public function start()
	{
		$route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$re    = '/[^\/]+/';
		preg_match_all($re, $route, $matches);
		$r1      = isset($matches[0][1]) ? '/' . $matches[0][1] : '/';
		$r2      = isset($matches[0][2]) ? $matches[0][2] : '/';
		$routing = Config::url();
		if (isset($routing[$r1])) {
			$controller     = 'app\\modules\\' . $routing[$r1]['module'] . '\\controllers\\' . $routing[$r1]['controller'] . 'Controller';
			$controller_obj = new $controller();

			$controller_obj->{$routing[$r1]['actions'][$r2]}();
		} else {
			echo 'Нет такого пути';
		}
		return $routing[$r1]['module'];
	}

	public function module()
	{
		$route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$re    = '/[^\/]+/';
		preg_match_all($re, $route, $matches);
		$r1      = isset($matches[0][1]) ? '/' . $matches[0][1] : '/';
		$routing = Config::url();
		return $routing[$r1]['module'];
	}
}