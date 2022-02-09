<?php
declare(strict_types=1);

namespace practice\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View;

class ViewProvider implements ServiceProviderInterface
{
    protected string $providerName = 'view';

    public function register(DiInterface $di) : void
    {
        $viewDir = $di->offsetGet('app_path') . '/resources/views';
        $di->setShared($this->providerName, function() use ($viewDir) {
            $view = new View();
            $view->setViewsDir($viewDir);
            $view->registerEngines([
                ".volt" => View\Engine\Volt::class
            ]);
            return $view;
        });
    }
}