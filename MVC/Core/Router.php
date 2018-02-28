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

        // Parameters from the matched route
        // @var array
        protected $params = [];

        /* 
            Add a route to the routing table
            @param string $route The route URL
            @param array $params Parameters (controller, action, etc.)

            @return void
        */
        public function add($route, $params = []) {
            // Convert the route to a regular expression: escape forward slashes
            $route = preg_replace('/\//', '\\/', $route);

            // Convert variables ex. {controller}
            $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);

            // Convert variable with custon regular expression {id:\d+}
            $route = preg_replace('/\{([a-z-]+):([^}]+)\}/', '(?P<\1>\2)', $route);

            // Add start and end delimiters, and case insensitive flag
            $route = '/^' . $route . '$/i';

            $this->routes[$route] = $params;
            
        }

        /* 
            Get all the routes from the routing table
            @return array
        */
        public function getRoutes() {
            return $this->routes;
        }

        /* 
            Match the route to the routes in the routing table, setting the params property if a route is found.
            @param string $url The route URL
            @return boolean true if a match found, false otherwise
        */
        public function match($url) {
            /* foreach($this->routes as $route => $params) {
                if($url == $route) {
                    $this->params = $params;
                    return TRUE;
                }
            } */

            // Match to the fixed URL format /controller/action
            // $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+$)/";

            foreach($this->routes as $route => $params) {
                if(preg_match($route, $url, $matches)) {
                    // Get named capture group values
                    // $params = [];
                    foreach($matches as $key => $match) {
                        if(is_string($key)) {
                            $params[$key] = $match;
                        }
                    }
                    $this->params = $params;
                    return TRUE;
                }
            }
        }

        /* 
            Get the currently match parameters
            @return array
        */
        public function getParams() {
            return $this->params;
        }
    }