<?php
declare(strict_types = 1);
namespace practice\Providers;

use Phalcon\Escaper;
use Phalcon\Flash\Session as flash;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Session\Manager;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class FlashSession implements ServiceProviderInterface
{
    public function register(DiInterface $di) : void
    {
        $di->setShared('flashSession', function () {
            $session = new Manager();
            $files = new Stream(
                [
                    'savePath' => $this->offsetGet('app_path')."/storage/tmp",
                ]
            );
            $session->setAdapter($files);

            $session->start();
            $escaper = new Escaper();
            $flash = new flash($escaper, $session);
            return $flash;
        });
    }
}