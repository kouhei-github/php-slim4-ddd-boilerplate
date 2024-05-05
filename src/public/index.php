<?php
require __DIR__ . '/../vendor/autoload.php';
require 'bootstrap/app.php';


$webhook = \di\Injection::inject();

$app     = $webhook->register();

$app->run();