<?php
declare(strict_types=1);

namespace demo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View;

class ViewProvider implements ServiceProviderInterface
{
    protected string $providerName = 'view';

    public function register(DiInterface $di) : void
    {
        $viewDir = $di->offsetGet('rootPath') . '/resources/views';
        $di->setShared($this->providerName, function() use ($viewDir) {
            $view = new View();
            $view->setViewsDir($viewDir);
            return $view;
        });
    }
}