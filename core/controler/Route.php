<?php

class Route
{

    private static $routes = array();

    public static function addAllRoutes() {
        self::add('~^/$~',"get","front","front");

        // Routes de login et de logout
        self::add('~^/login$~',"get","admin/login","login");
        self::add('~^/logout$~',"get","front","logout");
        self::add('~^/login$~',"post","admin/login_result","login");

        // Routes des nodes en visualisation et en administration
        self::add('~^/node/([0-9]+)/?$~',"get","node","node");
        self::add('~^/node/([0-9]+)/edit$~',"get","admin/node_edit_form","node_edit_form");
        self::add('~^/node/add$~',"get","admin/node_add_form","node_add");
        self::add('~^/node/add$~',"post","admin/list_node_admin","node_add");
        self::add('~^/node/([0-9]+)/delete$~',"get","admin/list_node_admin","node_delete");
        self::add('~^/node/[0-9]+/edited$~',"post","admin/node_edit_form","node_submited_form");
        self::add('~^/list-node-admin$~',"get","admin/list_node_admin","list_node_admin");
    }


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
            if (strtolower($route['method']) == strtolower($method)) {
                // on compare ensuite l'expression régulière
                if (preg_match($route['pattern'], $path)) {
                    $path_match_found = true;

                    // Cas de l'affichage d'un node ou de l'affichage du formulaire de modification d'un node
                    if (($route["model_name"] == "node" ||
                            $route["model_name"] == "node_edit_form") &&
                        $route["method"] == "get") {
                        preg_match($route["pattern"], $path, $matches, PREG_OFFSET_CAPTURE);
                        if (isset($matches[1][0])) {
                            $route["model_parameters"]["nid"] = $matches[1][0];
                            $route["model_parameters"]["edited"] = false;
                        }

                        // Cas de la soumission du formulaire de modification d'un node
                    } else if ($route["model_name"] == "node_submited_form" && $route["method"] == "post") {
                        $route["model_parameters"]["nid"] = $_POST["nid"];
                        $route["model_parameters"]["edited"] = true;
                    } // Cas de la suppression d'un node
                    else if ($route["model_name"] == "node_delete" && $route["method"] == "get") {
                        preg_match($route["pattern"], $path, $matches, PREG_OFFSET_CAPTURE);
                        if (isset($matches[1][0])) {
                            $route["model_parameters"]["nid"] = $matches[1][0];
                        }
                    }

                    return $route;
                    break;
                }
            }
        }
        // si on ne trouve pas le chemin, on retourne null
        return null;

    }

}