<?php


namespace app\core;


class app
{
	public static $test;

	public static function t(){

		return new app();
	}

	public function e(){
		return $this;
	}
}