<?php
    ## The Router decides which controller and action to run based on the route
    // It contains a table that matches routes to controllers and actions
    /* 
        "/"           | Home        | index
        "/posts"      | Posts       | index
        "/show_post"  | Posts       | show
        "/admin/uders"| Admin\Users | index
        ...
    */
    class Router {
        // Associative array of routes (the routing table) 
        // @var array
        protected $routes = [];

        /* 
            Add a route to the routing table
            @param string $route The route URL
            @param array $params Parameters (controller, action, etc.)

            @return void
        */
        public function add($route, $params) {
            $this->routes[$route] = $params;
        }

        /* 
            Get all the routes from the routing table
            @return array
        */
        public function getRoutes() {
            return $this->routes;
        }
    }