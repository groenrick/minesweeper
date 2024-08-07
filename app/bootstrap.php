<?php

use DI\ContainerBuilder;
use Rickgroen\Minesweeper\App;

////\Spatie\Ignition\Ignition::make()->register();
//\Spatie\Ignition\Ignition::make()
////    ->applicationPath(__DIR__ . '/..')
//    ->setEditor('phpstorm')
//    ->register();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = (new ContainerBuilder)
    ->addDefinitions('../config/bindings.php')
    ->build();

$container
    ->get(App::class)
    ->run();