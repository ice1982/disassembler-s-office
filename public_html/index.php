<?php

require_once(dirname( __FILE__ ) . '/environment.php');

require_once($yii);

$config_main   = require_once( dirname( __FILE__ ) . $protected . '/config/frontend.php' );
$config_server = require_once( dirname( __FILE__ ) . $protected . '/config/environment/' . $environment . '.php' );


$app_class_path = dirname(__FILE__) . $protected . '/modules/core/components/base/BaseWebApplication.php';

require_once($app_class_path);


$config = CMap::mergeArray($config_main, $config_server);

Yii::createApplication('BaseWebApplication', $config)->runEnd('frontend');

?>
