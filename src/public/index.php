<?php
require __DIR__ . '/../vendor/autoload.php';

$webhook = \di\Injection::inject();

$app = $webhook->register();

$app->run();