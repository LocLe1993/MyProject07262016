<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/config.php';

$app = new \MyProject\Application;
$app['debug'] = DEBUG_MODE;
$app->initialize();

$app->run();
