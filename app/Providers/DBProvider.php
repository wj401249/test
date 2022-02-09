<?php
declare(strict_types = 1);
namespace practice\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DBProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di) : void
    {
        $di->setShared('db', function () {
            $db_config = $this->get('config')->database->toArray();

            $adapterClass = "Phalcon\Db\Adapter\Pdo\\" . $db_config['adapter'];

            unset($db_config['adapter']);

            return new $adapterClass($db_config);
        });
    }
}