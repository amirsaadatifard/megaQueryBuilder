<?php

declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Exception/exception.php';

$db = new mysqli('jkshfsdf','root','','asdasd');

//$config = \App\Helpers\Config::get('app','app_name');
$config = \App\Helpers\Config::getFileContent('apadasdasdp');
var_dump($config);

$application = new \App\Helpers\App();
var_dump($application->getServeTime());
//var_dump($config);