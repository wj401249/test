<?php
declare(strict_types = 1);
define('APP_PATH', dirname(__DIR__));

use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;

echo APP_PATH;
require_once APP_PATH . "/vendor/autoload.php";

try {
    $app = new Application(new FactoryDefault());
    $app->handle($_SERVER['REQUEST_URI'])->send();
}catch (Exception $e) {
    echo $e->getMessage();
}