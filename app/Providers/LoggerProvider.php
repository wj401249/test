<?php
declare(strict_types = 1);
namespace practice\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Logger;

class LoggerProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di) : void
    {
        $di->setShared('logger', function () {
            $format = new Logger\Formatter\Line();
            $format->setDateFormat('Y-m-d H:i:s');
            $format->setFormat('[%date%] - [%type%] : %message%');

            $adapter = new Logger\Adapter\Stream($this->offsetGet('app_path')."/storage/log/" . date('Ymd') . ".log");
            $adapter->setFormatter($format);
            return new Logger('logger', ['message' => $adapter]);
        });
    }
}