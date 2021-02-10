<?php

class Route
{

    private static $routes = array();

    public static function add($regexp, $method = 'get', $model_name = 'single_node', $view_name = 'view_standard', $permission = "all")
    {
        array_push(self::$routes, array(
            'regexp' => $regexp,
            'method' => $method,
            'model_name' => $model_name,
            'view_name' => $view_name,
            'permission' => $permission,
        ));
    }


    public static function run($basepath = '/')
    {

        // Parse current url
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        $path = isset($parsed_url['path']) ? $parsed_url['path'] : '/';
        echo "chemin : ";
        var_dump($path);

       /* // Get current request method
        $method = $_SERVER['REQUEST_METHOD'];

        $path_match_found = false;

        $route_match_found = false;

        foreach (self::$routes as $route) {

        // If the method matches check the path

        // Add basepath to matching string
            if ($basepath != '' && $basepath != '/') {
                $route['expression'] = '(' . $basepath . ')' . $route['expression'];
            }

        // Add 'find string start' automatically
            $route['expression'] = '^' . $route['expression'];

        // Add 'find string end' automatically
            $route['expression'] = $route['expression'] . '$';

        // echo $route['expression'].'<br/>';

        // Check path match
            if (preg_match('#' . $route['expression'] . '#', $path, $matches)) {

                $path_match_found = true;

        // Check method match
                if (strtolower($method) == strtolower($route['method'])) {

                    array_shift($matches);// Always remove first element. This contains the whole string

                    if ($basepath != '' && $basepath != '/') {
                        array_shift($matches);// Remove basepath
                    }

                    call_user_func_array($route['function'], $matches);

                    $route_match_found = true;
                    // Do not check other routes
                    break;
                }
            }
        }

        // No matching route was found
        if (!$route_match_found) {

        // But a matching path exists
            if ($path_match_found) {
                header("HTTP/1.0 405 Method Not Allowed");
                if (self::$methodNotAllowed) {
                    call_user_func_array(self::$methodNotAllowed, array($path, $method));
                }
            } else {
                header("HTTP/1.0 404 Not Found");
                if (self::$pathNotFound) {
                    call_user_func_array(self::$pathNotFound, array($path));
                }
            }

        }*/

    }

}