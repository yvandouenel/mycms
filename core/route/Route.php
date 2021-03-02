<?php

class Route {

  private static $routes = [];

  public static function addAllRoutes($nodes) {
    self::add('~^/$~', "get", "front", "displayFront");

    // Routes de login et de logout
    self::add('~^/login$~', "get", "admin/login", "displayLoginForm");
    self::add('~^/logout$~', "get", "front", "logout");
    self::add('~^/login$~', "post", "admin/login_result", "login");

    // Routes des nodes en visualisation et en administration
    self::add('~^/node/([0-9]+)/?$~', "get", "node", "displayNode");
    self::add('~^/node/([0-9]+)/edit$~', "get", "admin/node_edit_form", "nodeEditForm");
    self::add('~^/node/[0-9]+/edited$~', "post", "admin/node_edit_form", "nodeSubmitForm");
    self::add('~^/node/add$~', "get", "admin/node_add_form", "displayAddForm");
    self::add('~^/node/add$~', "post", "admin/list_node_admin", "nodeAdd");
    self::add('~^/node/([0-9]+)/delete$~', "get", "admin/list_node_admin", "nodeDelete");
    self::add('~^/list-node-admin$~', "get", "admin/list_node_admin", "listNodeAdmin");

    // Ajout des routes qui proviennent de la base de données
    while ($d = $nodes->fetch(PDO::FETCH_OBJ)) {
      if ($d->path) {
        self::add('~^/' . $d->path . '$~', "get", "node", "displayNode",["nid" => $d->nid, "edited" => false]);
      }
    }

  }
  public static function add($pattern,
                             $method = 'get',
                             $view_name = 'view_standard',
                             $controller_method = 'view') {
    array_push(self::$routes, [
      'pattern' => $pattern,
      'method' => $method,
      'view_name' => $view_name,
      'controller_method' => $controller_method,
    ]);
  }

  public static function run() {

    // Parse l'URL
    $parsed_url = parse_url($_SERVER['REQUEST_URI']);

    $path = isset($parsed_url['path']) ? $parsed_url['path'] : '/';

    // Récupère la méthode
    $method = $_SERVER['REQUEST_METHOD'];

    // vérifie si la route existe
    $path_match_found = FALSE;
    $route_match_found = FALSE;
    foreach (self::$routes as $route) {
      // on compare d'abord la méthode
      if (strtolower($route['method']) == strtolower($method)) {
        // on compare ensuite l'expression régulière
        if (preg_match($route['pattern'], $path)) {
          $path_match_found = TRUE;

          return $route;
          break;
        }
      }
    }
    // si on ne trouve pas le chemin, on retourne null
    return NULL;

  }

}