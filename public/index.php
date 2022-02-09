<?php
declare(strict_types = 1);
define('APP_PATH', dirname(__DIR__));

use bootstrap\Bootstrap;

require_once APP_PATH . "/vendor/autoload.php";

try {
    $bootstrap = new Bootstrap(APP_PATH);

    $app = $bootstrap->run();

    $app->handle($_SERVER['REQUEST_URI'])->send();
}catch (Exception $e) {
    echo $e->getMessage();
}