<?php
    /**** FRONT CONTROLLER ****/


    // print "Hello World from Public folder<br>";
    // echo 'Requested URL "' . $_SERVER['QUERY_STRING'] . '"';

/* Rooting */
    require '../Core/Router.php';

    $router = new Router();

    // echo get_class($router); // Testing if it is working fine, will print the name of the router

    // Add the routes (the empty route is the hompage)
    $router->add('', ['controller' => 'Home', 'action' => 'index']);
    $router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
    // $router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
    $router->add('{controller}/{action}');
    $router->add('admin/{action}/{controller}');
    $router->add('admin/{action}/{id:\d+}/{controller}');

    // Display the routing table
    echo '<pre>';
    var_dump($router->getRoutes());
    echo '</pre>';
    
    // Match the requested route
    $url = $_SERVER['QUERY_STRING'];

    if($router->match($url)) {
        echo '<pre>';
        var_dump($router->getParams());
        echo '</pre>';
    } else {
        echo "No route found for URL '$url'";
    }