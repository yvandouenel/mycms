<?php

class Route
{

    private static $routes = array();

    public static function add($pattern,
                               $method = 'get',
                               $view_name = 'view_standard',
                               $model_name = 'node',
                               $model_parameters = [],
                               $permission = "all")
    {
        array_push(self::$routes, array(
            'pattern' => $pattern,
            'method' => $method,
            'view_name' => $view_name,
            'model_name' => $model_name,
            'model_parameters' => $model_parameters,
            'permission' => $permission,
        ));
    }

    public static function run()
    {

        // Parse l'URL
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        $path = isset($parsed_url['path']) ? $parsed_url['path'] : '/';

        // Récupère la méthode
        $method = $_SERVER['REQUEST_METHOD'];

        // vérifie si la route existe
        $path_match_found = false;
        $route_match_found = false;
        foreach (self::$routes as $route) {
            // on compare d'abord la méthode
            if(strtolower($route['method']) == strtolower($method)) {
                // on compare ensuite l'expression régulière
                if(preg_match($route['pattern'], $path)) {
                    $path_match_found = true;

                    // Cas de l'affichage d'un node ou de l'affichage du formulaire de modification d'un node
                    if(($route["model_name"] == "node" ||
                        $route["model_name"] == "node_edit_form" ) &&
                        $route["method"] == "get") {
                        preg_match($route["pattern"], $path, $matches, PREG_OFFSET_CAPTURE);
                        if (isset($matches[1][0])) {
                            $route["model_parameters"]["nid"] = $matches[1][0];
                            $route["model_parameters"]["edited"] = false;
                        }

                        // Cas de la soumission du formulaire de modification d'un node
                    } else if($route["model_name"] == "node_submited_form" && $route["method"] == "post") {
                        $route["model_parameters"]["nid"] = $_POST["nid"];
                        $route["model_parameters"]["edited"] = true;
                    }
                        // Dans le cas de l'appel du login on vérifie qu'il n'y a pas déjà eu une erreur
                    else if($route["model_name"] == "login" && $route["method"] == "get") {
                        preg_match($route["pattern"], $path, $matches, PREG_OFFSET_CAPTURE);
                        if (isset($matches[1][0])) {
                            $route["error"] = true;
                        }
                    }
                    return $route;
                    break;
                }
            }
        }
        // si on ne trouve pas le chemin, on retourne null
        return null;

       /* // Get current request method


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