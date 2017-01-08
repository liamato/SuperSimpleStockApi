<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Illuminate\Support\ClassLoader;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Routing\RoutingServiceProvider;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;

$basePath = str_finish(dirname(__DIR__), '/');

$dirs = [$basePath];

ClassLoader::register();
ClassLoader::addDirectories($dirs);

$app = new Container;
Facade::setFacadeApplication($app);

$app['app'] = $app;
$app['env'] = 'production';

with(new EventServiceProvider($app))->register();
with(new RoutingServiceProvider($app))->register();
with(new DatabaseServiceProvider($app))->register();

require $basePath . 'database.php';

require $basePath . 'routes.php';

$request = Request::createFromGlobals();
$response = $app['router']->dispatch($request);

$response->send();

