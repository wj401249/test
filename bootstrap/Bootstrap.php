<?php
declare(strict_types = 1);

namespace bootstrap;

use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault as Di;

class Bootstrap
{
    private Di $di;
    public function __construct(string $app_path)
    {
        $this->di = new Di();
        $this->di->offsetSet('app_path', function () use ($app_path) {
            return $app_path;
        });
        $this->di->getShared('dispatcher')->setDefaultNamespace("practice\Controllers");

        $headers = $this->di->getShared('assets')->collection("headers");

        $headers->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', false);
        $headers->addJs('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', false);
    }

    public function run() : Application
    {
        $this->registerProviders();
        return new Application($this->di);
    }

    private function registerProviders()
    {
        $providers = require_once $this->di->getShared('app_path') . '/config/providers.php';
        foreach ($providers as $provider) {
            (new $provider)->register($this->di);
        }
    }

}