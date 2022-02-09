<?php
use practice\Providers\ConfigProvider;
use practice\Providers\ViewProvider;
use practice\Providers\LoggerProvider;
use practice\Providers\CacheProvider;
use practice\Providers\DBProvider;
use practice\Providers\FlashSession;

return [
    'config' => ConfigProvider::class,
    'view' => ViewProvider::class,
    'Logger' => LoggerProvider::class,
    'cache' => CacheProvider::class,
    'db' => DBProvider::class,
    'flashSession' => FlashSession::class
];