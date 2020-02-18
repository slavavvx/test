<?php

    require_once '../route/route.php';

    $route = new Route();

    $controllerPath = $route->getControllerPath();

    require_once $controllerPath;
    
    $route->startAction();

?>