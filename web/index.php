<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../vendor/autoload.php';
date_default_timezone_set('Etc/GMT+3');

$router = new \app\core\Router();
$router->start();
