<?php 

require_once __DIR__.'/../vendor/autoload.php';

use Demo\Base\App;
use Demo\Base\Container;

try {

    //dependencies
    $container = new Container();

    $services = require_once __DIR__ . "/Config/service.php";
    
    // initialize providers 
    foreach( $services as $service) {
        $provider = new $service($container);
        $provider->init();
    }
    
    $app = new App($container);
    $app->run();

} catch (\ErrorException $e) {
    $e->getMessage();
}