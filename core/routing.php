<?php

namespace app\core;

class routing
{
	public $routing = [
		'/'             => [
			'module'     => 'main',
			'controller' => 'main',
			'actions'    => [
				'/' => 'index',
			]
		],
		'/main'         => [
			'module'     => 'main',
			'controller' => 'main',
			'actions'    => [
				'getdata'  => 'getdata',
				'get_text' => 'get_text'
			]
		],
		'/calculation'  => [
			'module'     => 'calculation',
			'controller' => 'calculation',
			'actions'    => [
				'/' => 'index'
			]
		],
		'/calculation2' => [
			'module'     => 'calculation2',
			'controller' => 'calculation',
			'actions'    => [
				'/'          => 'index',
				'get_points' => 'get_points'
			]
		],
		'/login'        => [
			'module'     => 'login',
			'controller' => 'login',
			'actions'    => [
				'/' => 'index'
			]
		],
		'/schedule'     => [
			'module'     => 'schedule',
			'controller' => 'schedule',
			'actions'    => [
				'/'           => 'index',
				'week'        => 'week',
				'get_weeks'   => 'get_weeks',
				'holyday'     => 'holyday',
				'save'        => 'save',
				'holyday_del' => 'holyday_del',
				'modal'       => 'modal'
			]
		],
		'/options'      => [
			'module'     => 'options',
			'controller' => 'options',
			'actions'    => [
				'/'         => 'index',
				'get_weeks' => 'get_weeks',
				'week'      => 'week',
				'save'      => 'save'
			]
		],
		'/rating'       => [
			'module'     => 'rating',
			'controller' => 'rating',
			'actions'    => [
				'/' => 'index'
			]
		],
		'/flags'        => [
			'module'     => 'flags',
			'controller' => 'flags',
			'actions'    => [
				'/'              => 'index',
				'get_flags_html' => 'get_flags_html',
				'save_flag'      => 'save_flag'
			]
		],
	];
}