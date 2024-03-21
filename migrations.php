<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/settings.php';

$migrations = new \Database\Migration();
$migrations->run();
