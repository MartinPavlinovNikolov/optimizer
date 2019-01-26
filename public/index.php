<?php

use MPN\App;
use MPN\Loader;

header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL ^ E_NOTICE);
include '../../MPN/App.php';
$app = App::getInstance();
Loader::registerNamespace('Optimizer\Models', 'C:\xampp\htdocs\optimizer\models');
$app->run();
