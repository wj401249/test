<?php
declare(strict_types = 1);

namespace practice\Providers;

use Phalcon\Config;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class ConfigProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di) : void
    {
        $app_path = $di->offsetGet('app_path');
        $di->setShared('config', function () use ($app_path) {
            $config = require_once $app_path . '/config/config.php';
            return new Config($config);
        });
    }
}