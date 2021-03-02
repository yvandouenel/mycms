<?php

class Controller {

  public static function displayNode($route) {
    $parsed_url = parse_url($_SERVER['REQUEST_URI']);
    $path = isset($parsed_url['path']) ? substr($parsed_url['path'], 1) : '/';
    // on vérifie si la route permet de récupérer directement la donnée ********
    $data["node"] = Model::getNodeByPath($path);
    if ($data["node"]) {
      $data["seo_title"] = $data["node"]->seo_title;
    }
    else {
      // récupération du nid via l'url *****************************************
      $nid = self::getNidByUrl($route);
      if ($nid) {
        $data["node"] = Model::getNode($nid);
        $data["seo_title"] = $data["node"]->seo_title;
      }
      // 404
    }
    // si ce node a un alias et qu'il n'est pas utilisé, on redirige
    if ($data["node"]->path && !preg_match($route["pattern"], "/" . $data["node"]->path)) {
      if ($data["node"]->path == "/") {
        header("location:/");
      }
      else {
        header("location:/" . $data["node"]->path);
      }
    }
    return $data;
  }

  public static function displayFront($route) {
    $data["node"] = Model::getNodeByPath("/");
    $data["seo_title"] = $data["node"]->seo_title;
    return $data;
  }

  public static function displayLoginForm() {
    $data["seo_title"] = "Identification";
    return $data;
  }

  public static function login(&$route) {
    $data["seo_title"] = "Identification";
    if (!Model::getUser()) {
      $route["view_name"] = "admin/login";
    }
    else {
      Model::getAdminMenu();
    }
    return $data;
  }

  public static function logout() {
    Model::logoutUser();
    $data["node"] = Model::getNodeByPath("/");
    $data["seo_title"] = $data["node"]->seo_title;
    return $data;
  }

  public static function listNodeAdmin() {
    $data["list"] = Model::getNodes();
    $data["seo_title"] = "Liste des nodes pour l'administration";
    return $data;
  }

  public static function nodeEditForm($route) {
    $data["node"] = Model::getNode(self::getNidByUrl($route));
    $data["seo_title"] = $data["node"]->seo_title;
    return $data;
  }

  public static function nodeSubmitForm($route) {
    Model::setNode();
    $nid = $_POST["nid"];

    $data["node"] = Model::getNode($nid);
    $data["seo_title"] = $data["node"]->seo_title;
    return $data;
  }

  public static function displayAddForm() {
    $data["seo_title"] = "Ajout d'un node";
    return $data;
  }

  public static function nodeAdd($route) {
    Model::addNode();
    $data["list"] = Model::getNodes();
    $data["seo_title"] = "Liste des nodes pour l'administration";
    return $data;
  }

  public static function nodeDelete($route) {
    Model::deleteNode(self::getNidByUrl($route));
    $data["list"] = Model::getNodes();
    $data["seo_title"] = "Liste des nodes pour l'administration";
    return $data;
  }

  private static function getNidByUrl($route) {
    $parsed_url = parse_url($_SERVER['REQUEST_URI']);
    $path = isset($parsed_url['path']) ? $parsed_url['path'] : '/';
    preg_match($route["pattern"], $path, $matches, PREG_OFFSET_CAPTURE);
    if (isset($matches[1][0])) {
      return $matches[1][0];
    }
    return 0;
  }

}
