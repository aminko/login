<?php 

require_once __DIR__.'/../vendor/autoload.php';

use Demo\Base\App;
use Demo\Base\Container;

try {
    
    $container = new Container();

    //dependencies..
   
    // start
    $app = new App($container);
    $app->run();

} catch (\ErrorException $e) {
    $e->getMessage();
}