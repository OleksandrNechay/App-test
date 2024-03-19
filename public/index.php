<?php

require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../settings.php';

$app = new \Core\Application();
require_once __DIR__.'/../routes/routes.php';


$app->run();